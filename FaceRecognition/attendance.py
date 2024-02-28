import cv2
import numpy as np
import csv
import datetime
from keras.models import load_model

# Load the trained face recognition model
model = load_model('facial_recognition_model.h5')

# Set the CSV file path to save the attendance records
csv_file = r"C:\Users\lenovo\Desktop\FaceRecognition\attendance\attendance.csv"

# Initialize the webcam or video capture
video_capture = cv2.VideoCapture(0)

# Load the face cascade classifier
face_cascade = cv2.CascadeClassifier(r'C:\Users\lenovo\Desktop\FaceRecognition\haarcascade_frontalface_default.xml')

def save_attendance(file_name):
    # Save the attendance record to the CSV file
    with open(csv_file, 'a', newline='') as file:
        writer = csv.writer(file)
        writer.writerow([file_name, datetime.datetime.now()])

# Mapping of labels to photo names
label_to_photo = {
    "0": "nabin",
    "1": "oli",
    "2": "puskar",
    "3": "rupesh",
    "4": "saugat"
}

# Flag to indicate if attendance has been recorded
attendance_recorded = False

while True:
    # Capture frame-by-frame from the video stream
    ret, frame = video_capture.read()

    # Check if the frame is empty
    if not ret:
        continue

    # Convert the frame to grayscale
    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # Detect faces in the frame
    faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    # Print the number of detected faces
    print("Number of Faces Detected:", len(faces))

    # Preprocess and classify the faces
    for (x, y, w, h) in faces:
        # Extract the face region from the frame
        face = gray_frame[y:y+h, x:x+w]
        face = cv2.resize(face, (150, 150))
        face_rgb = cv2.cvtColor(face, cv2.COLOR_GRAY2RGB)
        face_rgb = face_rgb.astype("float") / 255.0
        face_rgb = np.expand_dims(face_rgb, axis=0)

        # Classify the face using the trained model
        predictions = model.predict(face_rgb)
        predicted_label = np.argmax(predictions[0])
        confidence = predictions[0][predicted_label]

        # Get the class name associated with the predicted label
        class_name = label_to_photo.get(str(predicted_label), "Unknown")

        # Draw a box around the face and display the name
        cv2.rectangle(frame, (x, y), (x+w, y+h), (0, 0, 255), 2)
        cv2.putText(frame, class_name, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.75, (0, 0, 255), 2)

        # Save the attendance record if not recorded already
        if not attendance_recorded:
            save_attendance(class_name)
            attendance_recorded = True

        # Print the predicted label and confidence for each face
        print("Predicted Label:", predicted_label)
        print("Confidence:", confidence)

    # Display the resulting frame
    cv2.imshow('Face Recognition', frame)

    # Exit the loop if the 'q' key is pressed
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release the video capture and close all windows
video_capture.release()
cv2.destroyAllWindows()
