package com.example.driversdoor;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.FirebaseApp;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.sql.Driver;
public class LoginActivity extends AppCompatActivity {

    private EditText emailEditText, passwordEditText;
    private FirebaseAuth firebaseAuth;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        FirebaseApp.initializeApp(this);
        firebaseAuth = FirebaseAuth.getInstance();

        emailEditText = findViewById(R.id.emailEditText);
        passwordEditText = findViewById(R.id.passwordEditText);


    }

    public void onLoginButtonClicked(View view) {
        String email = emailEditText.getText().toString().trim();
        String password = passwordEditText.getText().toString();

        // Validate fields
        if (email.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please fill in all required fields.", Toast.LENGTH_SHORT).show();
            return;
        }

        // Use Firebase Authentication to sign in the user with email and password
        firebaseAuth.signInWithEmailAndPassword(email, password)
                .addOnCompleteListener(this, task -> {
                    if (task.isSuccessful()) {
                        // Login successful, determine user type and navigate accordingly
                        String uid = firebaseAuth.getCurrentUser().getUid();
                        DatabaseReference usersRef = FirebaseDatabase.getInstance().getReference("users").child(uid).child("userType");
                        DatabaseReference driversRef = FirebaseDatabase.getInstance().getReference("drivers").child(uid).child("userType");

                        ValueEventListener userTypeUsersListener = new ValueEventListener() {
                            @Override
                            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                                String userType = dataSnapshot.getValue(String.class);
                                if (userType != null && userType.equals("Passenger")) {
                                    // Navigate to PassengerActivity
                                    Intent intent = new Intent(LoginActivity.this, PassengerActivity.class);
                                    startActivity(intent);
                                    finish();
                                }
                            }

                            @Override
                            public void onCancelled(@NonNull DatabaseError databaseError) {
                                // Handle database error
                                Log.e("UserTypeDebug", "Error reading user type data: " + databaseError.getMessage());
                                Toast.makeText(LoginActivity.this, "Error reading user type data.", Toast.LENGTH_SHORT).show();
                            }
                        };

                        ValueEventListener userTypeDriversListener = new ValueEventListener() {
                            @Override
                            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                                String userType = dataSnapshot.getValue(String.class);
                                if (userType != null && userType.equals("Driver")) {
                                    // Navigate to DriverActivity
                                    Intent intent = new Intent(LoginActivity.this, DriverActivity.class);
                                    startActivity(intent);
                                    finish();
                                }
                            }

                            @Override
                            public void onCancelled(@NonNull DatabaseError databaseError) {
                                // Handle database error
                                Log.e("UserTypeDebug", "Error reading user type data: " + databaseError.getMessage());
                                Toast.makeText(LoginActivity.this, "Error reading user type data.", Toast.LENGTH_SHORT).show();
                            }
                        };

                        // Add listeners for both "users" and "drivers" nodes
                        usersRef.addListenerForSingleValueEvent(userTypeUsersListener);
                        driversRef.addListenerForSingleValueEvent(userTypeDriversListener);
                    } else {
                        // Login failed, show an error message
                        Toast.makeText(LoginActivity.this, "Invalid email or password. Please try again.", Toast.LENGTH_SHORT).show();
                    }
                });
    }

    public void onRegisterButtonClicked(View view) {
        Intent intent = new Intent(this, RegisterActivity.class);
        startActivity(intent);
    }
}
