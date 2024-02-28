import mysql.connector
import subprocess
from tkinter import *
from tkinter import ttk
from PIL import Image, ImageTk

class Face_Recognition_System:
    def __init__(self,root):
        self.root = root
        self.root.title("Face Recognition System")
        self.root.geometry("1530x790+0+0")
         
        # img = Image.open(r"C:\Users\lenovo\Desktop\FaceRecognition\main.jpg")
        # img = img.resize((500,130), Image.ANTIALIAS)
        # self.photoimg=ImageTk.PhotoImage(img)
        
        # f_lbl = Label(self.root,image=self.photoimg)
        # f_lbl.place(x=0,y=0,width=500,height=130)
        
        
        frame = Frame(self.root, bg="white")
        frame.place(x=520, y=100, width=800, height=550)

        lbl = Label(frame, text="Face Recognition System", font=("times new roman", 25, "bold"), fg="darkgreen", bg="white")
        lbl.place(x=20, y=20)
        
        
        
        studentDetails = Button(frame, text="Student Details",command=self.student_details,font=("times new roman", 10, "bold"),
            bd=3,relief=RIDGE,fg="white",bg="black",activeforeground="white",activebackground="black")
        studentDetails.place(x=50, y=130, width=250)               

        faceDetector = Button(frame, text="Face Detector",command=self.faceDetector, font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        faceDetector.place(x=370, y=130, width=250)

        attendance = Button(frame, text="Attendance",command=self.attendance, font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        attendance.place(x=50, y=200, width=250)
        
        trainData = Button(frame, text="Train Data",command=self.trainData, font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        trainData.place(x=370, y=200, width=250)
        
        photos = Button(frame, text="Photos",command=self.photos, font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        photos.place(x=50, y=370, width=250)
        
        
    def student_details(self):
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\studentDetails.py'])
        
    def faceDetector(self):
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\faceDetector.py'])
        
    def attendance(self):
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\attendance.py'])
    
    def trainData(self):
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\trainData.py'])
            
    def photos(self):
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\photos.py'])
        
        
        
        
if __name__ == "__main__":
    root=Tk()
    obj=Face_Recognition_System(root)
    root.mainloop()
        