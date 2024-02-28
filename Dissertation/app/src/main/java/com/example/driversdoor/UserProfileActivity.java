package com.example.driversdoor;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class UserProfileActivity extends AppCompatActivity {

    private TextView fullNameTextView;
    private TextView emailTextView;

    private Button logoutButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_profile);

        fullNameTextView = findViewById(R.id.userNameTextView);
        emailTextView = findViewById(R.id.userEmailTextView);
        logoutButton = findViewById(R.id.logoutButton);

        // Retrieve user details from Firebase Authentication
        FirebaseUser currentUser = FirebaseAuth.getInstance().getCurrentUser();

        if (currentUser != null) {
            String userFullName = currentUser.getDisplayName();
            String userEmail = currentUser.getEmail();

            // Display user data in TextViews
            if (userFullName != null) {
                fullNameTextView.setText("Full Name: " + userFullName);
            } else {
                // Full name is not set in the Firebase Authentication profile
                fullNameTextView.setText("Full Name: Not Available");
            }

            emailTextView.setText("Email: " + userEmail);
        } else {
            // Handle the case where the user is not logged in
            // You can redirect to the login screen or take appropriate action
        }

        logoutButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Perform logout actions here, e.g., clear user session, navigate to the login screen, etc.

                // For example, you can navigate back to the login screen:
                Intent intent = new Intent(UserProfileActivity.this, LoginActivity.class);
                startActivity(intent);
                finish(); // Close the current activity
            }
        });
    }
}





