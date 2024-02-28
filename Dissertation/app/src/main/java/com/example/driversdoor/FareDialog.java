package com.example.driversdoor;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.DialogFragment;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

public class FareDialog extends DialogFragment {

    final private String BASE_URL = "https://fcm.googleapis.com/fcm/send";
    final private String serverKey = "key=" + "APA91bHFRJ1VNYSZINorYE2wd1evyo0nFQ7HVRxv22rqd4I0n-cwXou5-LMdLhKAeeq1kKZijucju5vTIDapC4cqJXzYYKZsmkW09xafnd8AprsAi8wUtrx6Lm7loswCsQQGB-zHXGJs";
    final private String contentType = "application/json";
    final String TAG = "NOTIFICATION TAG";

    String NOTIFICATION_TITLE = "1 NEW NOTIFICATION";
    String NOTIFICATION_MESSAGE = "Request Arrived";
    String TOPIC = "Want to go for a ride..!!";

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

            Button startRideButton = view.findViewById(R.id.startButton);
            startRideButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    sendNotification();
                }
            });
        }
        return view;
    }

    private void sendNotification() {
        JSONObject notification = new JSONObject();
        JSONObject notificationBody = new JSONObject();
        try {
            notificationBody.put("title", NOTIFICATION_TITLE);
            notificationBody.put("message", NOTIFICATION_MESSAGE);
            notification.put("to", TOPIC);
            notification.put("data", notificationBody);
        } catch (JSONException e) {
            Log.e(TAG, "onCreate: " + e.getMessage());
        }
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(BASE_URL, notification,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        Log.i(TAG, "onResponse: " + response.toString());
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getContext(), "Request error", Toast.LENGTH_LONG).show();
                        Log.i(TAG, "onErrorResponse: Didn't work");
                    }
                }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("Authorization", serverKey);
                params.put("Content-Type", contentType);
                return params;
            }
        };
        MySingleton.getInstance(getContext()).addToRequestQueue(jsonObjectRequest);
    }
}
