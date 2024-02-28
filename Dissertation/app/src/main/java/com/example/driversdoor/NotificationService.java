package com.example.driversdoor;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Headers;
import retrofit2.http.POST;

public interface NotificationService {
    @Headers({
            "Content-Type: application/json",
            "Authorization: key=AAAAAPIRGck:APA91bHFRJ1VNYSZINorYE2wd1evyo0nFQ7HVRxv22rqd4I0n-cwXou5-LMdLhKAeeq1kKZijucju5vTIDapC4cqJXzYYKZsmkW09xafnd8AprsAi8wUtrx6Lm7loswCsQQGB-zHXGJs"
    })
    @POST("dissertation-91b67.cloudfunctions.net/sendNotification")
    Call<Void> sendNotification(@Body String notificationPayload);
}
