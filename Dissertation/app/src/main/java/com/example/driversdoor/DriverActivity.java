package com.example.driversdoor;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.messaging.FirebaseMessaging;
import org.osmdroid.api.IMapController;
import org.osmdroid.config.Configuration;
import org.osmdroid.views.MapView;
import org.osmdroid.util.GeoPoint;
import org.osmdroid.views.overlay.Marker;

public class DriverActivity extends AppCompatActivity {

    private MapView mapView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver);

        // Subscribe the driver to the FCM topic when the app starts
        subscribeToDriverTopic();

        ImageView profileImageView = findViewById(R.id.profileImage);
        profileImageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Open the UserProfileActivity
                Intent profileIntent = new Intent(DriverActivity.this, DriverProfileActivity.class);
                // Pass any necessary user data to the profile activity if needed
                startActivity(profileIntent);
                // Replace the above lines with your profile activity code
            }
        });

        mapView = findViewById(R.id.map);

        // Initialize the map controller
        Configuration.getInstance().setUserAgentValue(BuildConfig.APPLICATION_ID);
        mapView.setTileSource(org.osmdroid.tileprovider.tilesource.TileSourceFactory.MAPNIK);

        // Set the initial map location (Kathmandu, Nepal)
        IMapController mapController = mapView.getController();
        GeoPoint kathmanduLocation = new GeoPoint(27.7172, 85.3240);
        mapController.setCenter(kathmanduLocation);
        mapController.setZoom(15.0);

        // Add a marker at Kathmandu's location
        Marker kathmanduMarker = new Marker(mapView);
        kathmanduMarker.setPosition(kathmanduLocation);
        kathmanduMarker.setTitle("Kathmandu, Nepal");
        mapView.getOverlays().add(kathmanduMarker);

        ImageView notificationIcon = findViewById(R.id.notificationIcon);
        notificationIcon.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Show a dialog with passenger information or ride request details
                showPassengerInfoDialog();
            }
        });
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        // Unsubscribe the driver from the FCM topic when the app is destroyed (optional)
        unsubscribeFromDriverTopic();
    }

    private void subscribeToDriverTopic() {
        String topicName = "Enter_driver_topic_name"; // Replace with your actual topic name
        FirebaseMessaging.getInstance().subscribeToTopic(topicName)
                .addOnCompleteListener(task -> {
                    if (task.isSuccessful()) {
                        // Subscription successful
                    } else {
                        // Subscription failed
                    }
                });
    }

    private void unsubscribeFromDriverTopic() {
        String topicName = "Enter_driver_topic_name"; // Replace with your actual topic name
        FirebaseMessaging.getInstance().unsubscribeFromTopic(topicName)
                .addOnCompleteListener(task -> {
                    if (task.isSuccessful()) {
                        // Unsubscription successful
                    } else {
                        // Unsubscription failed
                    }
                });
    }

    private void showPassengerInfoDialog() {
        // Implement the code to show a dialog with passenger information or ride request details here.
        // You can use AlertDialog or any other dialog mechanism to display the information.

        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Ride Request");
        builder.setMessage("Passenger wants to start the ride. Do you accept?");
        builder.setPositiveButton("Accept", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                // Handle the acceptance of the ride request
            }
        });
        builder.setNegativeButton("Decline", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                // Handle the decline of the ride request
            }
        });
        builder.show();
    }
}
