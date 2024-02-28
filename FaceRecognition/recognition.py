import cv2
from keras.models import load_model
import numpy as np

# Set the path to the augmented dataset
augmentation_directory = r"C:\Users\lenovo\Desktop\FaceRecognition\augmentation"

# Set the path to the validation dataset
validation_directory = r"C:\Users\lenovo\Desktop\FaceRecognition\validation"

# Load the trained face recognition model
model = load_model('facial_recognition_model.h5')

# Initialize the face cascade
face_cascade = cv2.CascadeClassifier(r'C:\Users\lenovo\Desktop\FaceRecognition\haarcascade_frontalface_default.xml')

# Function to perform face recognition on a single face image
def recognize_face(image):
    # Convert the image to grayscale if it has only 2 channels
    if image.ndim == 2:
        image = cv2.cvtColor(image, cv2.COLOR_GRAY2BGR)

    # Convert the image to grayscale if it has only 1 channel
    if image.ndim == 3 and image.shape[-1] == 1:
        image = cv2.cvtColor(image, cv2.COLOR_GRAY2BGR)

    # Convert the image to grayscale
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Detect faces using the face cascade
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    # Iterate through detected faces
    for (x, y, w, h) in faces:
        # Crop the face region from the image
        face = image[y:y+h, x:x+w]

        # Set the input shape of the images
        input_shape = (150, 150)

        # Resize the face image to match the input shape of the model
        face = cv2.resize(face, input_shape)

        # Preprocess the face image
        face = np.expand_dims(face, axis=0)
        face = face / 255.0

        # Perform face recognition by passing the face through the model
        embedding = model.predict(face)
        
        # Perform matching or identification using the face embedding
        # You can compare the embedding with a known database of embeddings
        
        # Example: Print the predicted class for the face
        predicted_class = np.argmax(embedding, axis=1)
        print("Predicted Class:", predicted_class)

# Example usage
image_paths = [
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\rupesh.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\nabin.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\saugat.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\puskar.jpg",
    r"C:\Users\lenovo\Desktop\FaceRecognition\photos\oli.jpg"
]

# Perform face recognition for each image
for image_path in image_paths:
    image = cv2.imread(image_path)
    recognize_face(image)
