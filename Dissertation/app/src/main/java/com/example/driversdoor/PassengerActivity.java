package com.example.driversdoor;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;
import org.osmdroid.api.IMapController;
import org.osmdroid.config.Configuration;
import org.osmdroid.views.MapView;
import org.osmdroid.util.GeoPoint;
import org.osmdroid.views.overlay.Marker;

public class PassengerActivity extends AppCompatActivity {

    private Button startRideButton;
    private MapView mapView;


    private ImageView profileImageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_passenger);

        startRideButton = findViewById(R.id.startRideButton);
        mapView = findViewById(R.id.mapView);
        profileImageView = findViewById(R.id.profileImageView);



        // Initialize the map controller
        Configuration.getInstance().load(this, getSharedPreferences("osm", MODE_PRIVATE));
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


        ImageView profileImageView = findViewById(R.id.profileImageView);
        profileImageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Open the UserProfileActivity
                Intent profileIntent = new Intent(PassengerActivity.this, UserProfileActivity.class);
                // Pass any necessary user data to the profile activity if needed
                startActivity(profileIntent);
            }
        });


        startRideButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Show the ride type selection dialog
                RideTypeSelectionActivity rideTypeSelectionFragment = new RideTypeSelectionActivity();
                rideTypeSelectionFragment.show(getSupportFragmentManager(), rideTypeSelectionFragment.getTag());
            }
        });


    }
}
