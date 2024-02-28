import face_recognition

# List of image paths
image_paths = [
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\nabin.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\oli.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\puskar.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\rupesh.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\saugat.jpg"
]

# Loop through each image path
for path in image_paths:
    # Load an image with a face to encode
    image = face_recognition.load_image_file(path)

    # Find all the faces in the image
    face_locations = face_recognition.face_locations(image)

    # Encode the faces
    face_encodings = face_recognition.face_encodings(image, face_locations)

    # Check if any faces are found
    if len(face_encodings) > 0:
        # Save the face encoding
        face_encoding = face_encodings[0]

        # Perform further processing or save the face encoding for later use
        # ...

    else:
        print("No faces found in the image.")
