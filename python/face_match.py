import face_recognition
import sys
import os

# Get the path to the uploaded image
uploaded_path = sys.argv[1]

# Compute absolute path to Laravel's public/images
laravel_base_path = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
dataset_path = os.path.join(laravel_base_path, 'public', 'images')

known_encodings = []
known_filenames = []

# Loop through all known images
for filename in os.listdir(dataset_path):
    path = os.path.join(dataset_path, filename)
    image = face_recognition.load_image_file(path)
    encodings = face_recognition.face_encodings(image)
    if encodings:
        known_encodings.append(encodings[0])
        known_filenames.append(filename)

# Load the uploaded image
unknown_image = face_recognition.load_image_file(uploaded_path)
unknown_encodings = face_recognition.face_encodings(unknown_image)

if not unknown_encodings:
    print("not_found")
    sys.exit()

# Compare uploaded image with known images
for i, known_encoding in enumerate(known_encodings):
    result = face_recognition.compare_faces([known_encoding], unknown_encodings[0])
    if result[0]:
        print(known_filenames[i])
        sys.exit()

print("not_found")
