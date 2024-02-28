from keras.preprocessing.image import ImageDataGenerator
import cv2
import os

# Set the path to the directory where you want to save the augmented images
base_directory = r"C:\Users\lenovo\Desktop\FaceRecognition\augmentation"

# Load the original images
image_paths = {
    "rupesh": r"C:\Users\lenovo\Desktop\FaceRecognition\photos\rupesh.jpg",
    "saugat": r"C:\Users\lenovo\Desktop\FaceRecognition\photos\saugat.jpg",
    "nabin": r"C:\Users\lenovo\Desktop\FaceRecognition\photos\nabin.jpg",
    "puskar": r"C:\Users\lenovo\Desktop\FaceRecognition\photos\puskar.jpg",
    "oli": r"C:\Users\lenovo\Desktop\FaceRecognition\photos\oli.jpg",
}
# Create a dictionary to store the labels
labels = {
    "nabin": "Label for nabin.jpg",
    "oli": "Label for oli.jpg",
    "puskar": "Label for puskar.jpg",
    "rupesh": "Label for rupesh.jpg",
    "saugat": "Label for saugat.jpg"
}

# Create the save directories if they don't exist
os.makedirs(os.path.join(base_directory, "nabin"), exist_ok=True)
os.makedirs(os.path.join(base_directory, "oli"), exist_ok=True)
os.makedirs(os.path.join(base_directory, "puskar"), exist_ok=True)
os.makedirs(os.path.join(base_directory, "rupesh"), exist_ok=True)
os.makedirs(os.path.join(base_directory, "saugat"), exist_ok=True)

# Create an instance of the ImageDataGenerator
datagen = ImageDataGenerator(
    rotation_range=20,  # Rotate the image by up to 20 degrees
    width_shift_range=0.2,  # Shift the image horizontally by up to 20% of its width
    height_shift_range=0.2,  # Shift the image vertically by up to 20% of its height
    shear_range=0.2,  # Shear the image by up to 20 degrees
    zoom_range=0.2,  # Zoom in or out on the image by up to 20%
    horizontal_flip=True,  # Flip the image horizontally
    vertical_flip=True,  # Flip the image vertically
    brightness_range=(0.8, 1.2)  # Adjust the brightness of the image
)



# Generate augmented images for "rupesh.jpg"
image_path_nabin = image_paths["nabin"]
image_nabin = cv2.imread(image_path_nabin)
image_nabin = cv2.cvtColor(image_nabin, cv2.COLOR_BGR2RGB)
image_nabin = image_nabin.reshape((1,) + image_nabin.shape)

i = 0
for batch in datagen.flow(image_nabin, batch_size=1, save_to_dir=os.path.join(base_directory, "nabin"), save_prefix='aug', save_format='jpg'):
    i += 1
    if i >= 100:  # Generate 10 augmented images for "rupesh.jpg"
        break



# Generate augmented images for "saugat.jpg"
image_path_oli = image_paths["oli"]
image_oli = cv2.imread(image_path_oli)
image_oli = cv2.cvtColor(image_oli, cv2.COLOR_BGR2RGB)
image_oli = image_oli.reshape((1,) + image_oli.shape)

i = 0
for batch in datagen.flow(image_oli, batch_size=1, save_to_dir=os.path.join(base_directory, "oli"), save_prefix='aug', save_format='jpg'):
    i += 1
    if i >= 100:  # Generate 10 augmented images for "saugat.jpg"
        break
 

   
# Generate augmented images for "nabin.jpg"
image_path_puskar = image_paths["puskar"]
image_puskar = cv2.imread(image_path_puskar)
image_puskar = cv2.cvtColor(image_puskar, cv2.COLOR_BGR2RGB)
image_puskar = image_puskar.reshape((1,) + image_puskar.shape)

i = 0
for batch in datagen.flow(image_puskar, batch_size=1, save_to_dir=os.path.join(base_directory, "puskar"), save_prefix='aug', save_format='jpg'):
    i += 1
    if i >= 100:  # Generate 10 augmented images for "nabin.jpg"
        break



# Generate augmented images for "puskar.jpg"
image_path_rupesh = image_paths["rupesh"]
image_rupesh = cv2.imread(image_path_rupesh)
image_rupesh = cv2.cvtColor(image_rupesh, cv2.COLOR_BGR2RGB)
image_rupesh = image_rupesh.reshape((1,) + image_rupesh.shape)

i = 0
for batch in datagen.flow(image_rupesh, batch_size=1, save_to_dir=os.path.join(base_directory, "rupesh"), save_prefix='aug', save_format='jpg'):
    i += 1
    if i >= 100:  # Generate 10 augmented images for "puskar.jpg"
        break
 

   
# Generate augmented images for "oli.jpg"
image_path_saugat = image_paths["saugat"]
image_saugat = cv2.imread(image_path_saugat)
image_saugat = cv2.cvtColor(image_saugat, cv2.COLOR_BGR2RGB)
image_saugat = image_saugat.reshape((1,) + image_saugat.shape)

i = 0
for batch in datagen.flow(image_saugat, batch_size=1, save_to_dir=os.path.join(base_directory, "saugat"), save_prefix='aug', save_format='jpg'):
    i += 1
    if i >= 100:  # Generate 10 augmented images for "oli.jpg"
        break
    
print(labels)