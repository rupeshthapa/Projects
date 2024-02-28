package com.example.driversdoor;

import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.content.Context;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;
import androidx.fragment.app.DialogFragment;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import com.google.android.material.bottomsheet.BottomSheetDialogFragment;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RideTypeSelectionActivity extends BottomSheetDialogFragment {

    private String selectedRideType = "";
    private Button startButton;
    private Button cancelButton;
    private LinearLayout searchLayout;
    private EditText pickupEditText;
    private EditText dropoffEditText;



    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_ride_type_selection, container, false);

        // Initialize UI elements

        startButton = view.findViewById(R.id.startButton);
        cancelButton = view.findViewById(R.id.cancelButton);
        searchLayout = view.findViewById(R.id.searchLayout);
        pickupEditText = view.findViewById(R.id.pickupEditText);
        dropoffEditText = view.findViewById(R.id.dropoffEditText);

        // Set click listeners for ride type buttons
        Button economyButton = view.findViewById(R.id.economyButton);
        Button premiumButton = view.findViewById(R.id.premiumButton);
        Button sharedButton = view.findViewById(R.id.sharedButton);

        economyButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectedRideType = "Economy";
                searchLayout.setVisibility(View.VISIBLE);
            }
        });

        premiumButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectedRideType = "Premium";
                searchLayout.setVisibility(View.VISIBLE);
            }
        });

        sharedButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectedRideType = "Shared";
                searchLayout.setVisibility(View.VISIBLE);
            }
        });

        cancelButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchLayout.setVisibility(View.GONE);
            }
        });

        startButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String pickupLocation = pickupEditText.getText().toString();
                String dropoffLocation = dropoffEditText.getText().toString();
                if (!pickupLocation.isEmpty() && !dropoffLocation.isEmpty()) {
                    double fare = calculateFare(selectedRideType);
                    showFareDialog(fare);

                    // Send an FCM notification to drivers when the ride is started

                } else {
                    // Handle invalid locations (e.g., show an error message)
                }
            }
        });

        return view;
    }






    private double calculateFare(String rideType) {
        // Implement your fare calculation logic here based on the selected ride type
        // Return the calculated fare
        return 0.0; // Replace with your actual fare calculation logic
    }

    private void showFareDialog(double fare) {
        FareDialog fareDialog = new FareDialog();
        Bundle args = new Bundle();
        args.putDouble("fare", fare);
        fareDialog.setArguments(args);
        fareDialog.show(getChildFragmentManager(), "FareDialog");
    }

    public static class FareDialog extends DialogFragment {
        @Nullable
        @Override
        public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
            View view = inflater.inflate(R.layout.fare_dialog, container, false);

            Bundle args = getArguments();
            if (args != null) {
                double fare = args.getDouble("fare", 0.0);
                TextView fareResultTextView = view.findViewById(R.id.fareResultTextView);
                fareResultTextView.setText("Fare: $" + fare);

                Button closeButton = view.findViewById(R.id.closeButton);
                closeButton.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        dismiss();
                    }
                });
            }

            return view;
        }
    }
}
