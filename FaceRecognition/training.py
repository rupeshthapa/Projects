import numpy as np
from sklearn.metrics import classification_report
from keras.models import Sequential
from keras.layers import Conv2D, MaxPooling2D, Flatten, Dense
from keras.preprocessing.image import ImageDataGenerator

# Set the path to the augmented dataset
dataset_directory = r"C:\Users\lenovo\Desktop\FaceRecognition\augmentation"

# Set the number of classes (i.e., number of individuals)
num_classes = 5

# Set the input shape of the images
input_shape = (150, 150, 3)

# Create an instance of the ImageDataGenerator for training data
train_datagen = ImageDataGenerator(rescale=1./255)

# Load and augment the training data
train_data = train_datagen.flow_from_directory(
    dataset_directory,
    target_size=input_shape[:2],
    batch_size=32,
    class_mode='categorical',
    shuffle=True
)

# Create the model
model = Sequential()
model.add(Conv2D(32, (3, 3), activation='relu', input_shape=input_shape))
model.add(MaxPooling2D((2, 2)))
model.add(Conv2D(64, (3, 3), activation='relu'))
model.add(MaxPooling2D((2, 2)))
model.add(Conv2D(128, (3, 3), activation='relu'))
model.add(MaxPooling2D((2, 2)))
model.add(Flatten())
model.add(Dense(128, activation='relu'))
model.add(Dense(num_classes, activation='softmax'))

# Compile the model
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])

# Train the model
model.fit(train_data, epochs=10)

# Save the trained model
model.save('facial_recognition_model.h5')

# Set the path to the validation dataset
validation_directory = r"C:\Users\lenovo\Desktop\FaceRecognition\validation"

# Create an instance of the ImageDataGenerator for validation data
validation_datagen = ImageDataGenerator(rescale=1./255)

# Load the validation data
validation_data = validation_datagen.flow_from_directory(
    validation_directory,
    target_size=input_shape[:2],
    batch_size=32,
    class_mode='categorical',
    shuffle=False
)

# Evaluate the model on the validation data
loss, accuracy = model.evaluate(validation_data)
print("Loss: {:.2f}".format(loss))
print("Accuracy: {:.2f}".format(accuracy))

# Generate predictions for the validation data
predictions = model.predict(validation_data)
predicted_labels = np.argmax(predictions, axis=1)

# Get the true labels
true_labels = validation_data.classes

# Generate classification report
class_names = list(validation_data.class_indices.keys())
report = classification_report(true_labels, predicted_labels, target_names=class_names)
print("Classification Report:")
print(report)