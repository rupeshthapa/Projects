package com.example.driversdoor;// ...
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.FirebaseFirestoreException;
import com.google.firebase.firestore.ListenerRegistration;// ... (No changes made to the imports)

public class DriverProfileActivity extends AppCompatActivity {

    private TextView fullname;
    private TextView email;
    private TextView vehicleName;
    private TextView vehiclePlateNum;
    private TextView licenseNum;

    private Button logoutButton;

    private FirebaseAuth mAuth;
    private FirebaseFirestore db;
    private FirebaseUser currentUser;
    private ListenerRegistration userListener;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver_profile);

        fullname = findViewById(R.id.driverNameTextView);
        email = findViewById(R.id.driverEmailTextView);
        vehicleName = findViewById(R.id.driverVechileTextView);
        vehiclePlateNum = findViewById(R.id.driverPlateNumberTextView);
        licenseNum = findViewById(R.id.driverLicenseNumberTextView);
        logoutButton = findViewById(R.id.logoutButton);

        mAuth = FirebaseAuth.getInstance();
        db = FirebaseFirestore.getInstance();
        currentUser = mAuth.getCurrentUser();

        logoutButton.setOnClickListener(v -> {
            // Perform logout actions here, e.g., clear user session, navigate to the login screen, etc.

            // For example, you can navigate back to the login screen:
            Intent intent = new Intent(DriverProfileActivity.this, LoginActivity.class);
            startActivity(intent);
            finish(); // Close the current activity
        });

        if (currentUser != null) {
            String driverEmail = currentUser.getEmail();

            // Display user email using a resource string with a placeholder
            email.setText(getString(R.string.email_label, driverEmail));

            // Retrieve and display user's full name from Firebase Authentication
            String driverFullName = currentUser.getDisplayName();
            if (driverFullName != null) {
                fullname.setText(getString(R.string.full_name_label, driverFullName));
            } else {
                fullname.setText(getString(R.string.full_name_label, getString(R.string.not_available)));
            }

            // Retrieve and display vehicle information from Firestore
            userListener = db.collection("users")
                    .document(currentUser.getUid())
                    .addSnapshotListener((documentSnapshot, e) -> {
                        if (e != null) {
                            // Handle errors
                            Log.e("DriverProfileActivity", "Error fetching Firestore data: " + e.getMessage());
                            return;
                        }

                        if (documentSnapshot != null && documentSnapshot.exists()) {
                            String vehicle = documentSnapshot.getString("vehicle_name");
                            String plateNum = documentSnapshot.getString("plate_number");
                            String license = documentSnapshot.getString("license_number");

                            // Display vehicle information using resource strings with placeholders
                            if (vehicle != null) {
                                vehicleName.setText(getString(R.string.vehicle_label, vehicle));
                            }
                            if (plateNum != null) {
                                vehiclePlateNum.setText(getString(R.string.plate_number_label, plateNum));
                            }
                            if (license != null) {
                                licenseNum.setText(getString(R.string.license_number_label, license));
                            }
                        } else {
                            // Handle the case where the document doesn't exist
                            Log.e("DriverProfileActivity", "Document does not exist.");
                        }
                    });
        } else {
            // Handle the case where the user is not logged in
            // You can redirect to the login screen or take appropriate action
        }


    }


    @Override
    protected void onDestroy() {
        super.onDestroy();
        if (userListener != null) {
            userListener.remove();
        }
    }

}
