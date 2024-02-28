package com.example.driversdoor;

import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.UserProfileChangeRequest;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class RegisterActivity extends AppCompatActivity {
    private RadioGroup radioGroup;
    private EditText fullNameEditText, emailEditText, passwordEditText, confirmPasswordEditText;
    private EditText vehicleNameEditText, plateNumberEditText, licenseNumberEditText;

    private DatabaseReference databaseReference;
    private FirebaseAuth firebaseAuth;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        databaseReference = FirebaseDatabase.getInstance().getReference();
        firebaseAuth = FirebaseAuth.getInstance();

        radioGroup = findViewById(R.id.radioGroup);
        fullNameEditText = findViewById(R.id.fullNameEditText);
        emailEditText = findViewById(R.id.emailEditText);
        passwordEditText = findViewById(R.id.passwordEditText);
        confirmPasswordEditText = findViewById(R.id.confirmPasswordEditText);
        vehicleNameEditText = findViewById(R.id.vehicleNameEditText);
        plateNumberEditText = findViewById(R.id.plateNumberEditText);
        licenseNumberEditText = findViewById(R.id.licenseNumberEditText);

        radioGroup.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                // Check which radio button is selected
                if (checkedId == R.id.passengerRadioButton) {
                    // Passenger radio button is selected, hide driver details fields
                    vehicleNameEditText.setVisibility(View.GONE);
                    plateNumberEditText.setVisibility(View.GONE);
                    licenseNumberEditText.setVisibility(View.GONE);
                } else if (checkedId == R.id.driverRadioButton) {
                    // Driver radio button is selected, show driver details fields
                    vehicleNameEditText.setVisibility(View.VISIBLE);
                    plateNumberEditText.setVisibility(View.VISIBLE);
                    licenseNumberEditText.setVisibility(View.VISIBLE);
                }
            }
        });
    }

    public void onRegisterButtonClicked(View view) {
        final String fullName = fullNameEditText.getText().toString().trim();
        final String email = emailEditText.getText().toString().trim();
        final String password = passwordEditText.getText().toString();
        String confirmPassword = confirmPasswordEditText.getText().toString();
        final String vehicleName = vehicleNameEditText.getText().toString();
        final String plateNumber = plateNumberEditText.getText().toString();
        final String licenseNumber = licenseNumberEditText.getText().toString();

        // Validate fields
        if (fullName.isEmpty() || email.isEmpty() || password.isEmpty() || confirmPassword.isEmpty()) {
            Toast.makeText(this, "Please fill in all required fields.", Toast.LENGTH_SHORT).show();
            return;
        }

        if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            Toast.makeText(this, "Please enter a valid email address.", Toast.LENGTH_SHORT).show();
            return;
        }

        if (!password.equals(confirmPassword)) {
            Toast.makeText(this, "Passwords do not match. Please try again.", Toast.LENGTH_SHORT).show();
            return;
        }

        int selectedRadioButtonId = radioGroup.getCheckedRadioButtonId();
        RadioButton selectedRadioButton = findViewById(selectedRadioButtonId);

        final String userType = selectedRadioButton.getText().toString();

        // Use Firebase Authentication to create a user with the provided email and password
        firebaseAuth.createUserWithEmailAndPassword(email, password)
                .addOnCompleteListener(task -> {
                    if (task.isSuccessful()) {
                        // Registration successful, user is now registered.
                        FirebaseUser currentUser = FirebaseAuth.getInstance().getCurrentUser();

                        // Set user's full name in Firebase Authentication profile
                        UserProfileChangeRequest profileUpdates = new UserProfileChangeRequest.Builder()
                                .setDisplayName(fullName)
                                .build();

                        currentUser.updateProfile(profileUpdates)
                                .addOnCompleteListener(new OnCompleteListener<Void>() {
                                    @Override
                                    public void onComplete(@NonNull Task<Void> task) {
                                        if (task.isSuccessful()) {
                                            // Full name set in the Firebase Authentication profile
                                            // Continue with saving data to the database
                                            String userId = currentUser.getUid();

                                            // Obtain the FCM token
                                            currentUser.getIdToken(true)
                                                    .addOnCompleteListener(tokenTask -> {
                                                        if (tokenTask.isSuccessful()) {
                                                            String fcmToken = tokenTask.getResult().getToken();

                                                            // Save user data, including FCM token, to the database
                                                            saveUserDataToDatabase(userId, fullName, email, userType, vehicleName, plateNumber, licenseNumber, fcmToken);
                                                        } else {
                                                            // Handle FCM token retrieval failure
                                                            Toast.makeText(RegisterActivity.this, "FCM token retrieval failed.", Toast.LENGTH_SHORT).show();
                                                        }
                                                    });
                                        } else {
                                            // Handle profile update failure
                                            Toast.makeText(RegisterActivity.this, "Profile update failed.", Toast.LENGTH_SHORT).show();
                                        }
                                    }
                                });

                    }
                    else {
                        // Registration failed, show an error message
                        Toast.makeText(this, "Registration failed. Please try again.", Toast.LENGTH_SHORT).show();
                    }
                });
    }

    private void saveUserDataToDatabase(String userId, String fullName, String email, String userType, String vehicleName, String plateNumber, String licenseNumber, String fcmToken) {
        DatabaseReference userReference;
        if (userType.equals("Passenger")) {
            userReference = databaseReference.child("users").child(userId);
        } else if (userType.equals("Driver")) {
            userReference = databaseReference.child("drivers").child(userId);
            userReference.child("vehicle_name").setValue(vehicleName);
            userReference.child("plate_number").setValue(plateNumber);
            userReference.child("license_number").setValue(licenseNumber);
            // Add other driver information as needed...
        } else {
            // Invalid userType value
            Toast.makeText(this, "Invalid user type.", Toast.LENGTH_SHORT).show();
            return;
        }

        // Save common user information
        userReference.child("name").setValue(fullName);
        userReference.child("email").setValue(email);
        userReference.child("userType").setValue(userType); // Save user type
        userReference.child("fcmToken").setValue(fcmToken); // Save FCM token

        // Data saved successfully, show a success message
        Toast.makeText(this, userType + " registered successfully.", Toast.LENGTH_SHORT).show();
    }
}
