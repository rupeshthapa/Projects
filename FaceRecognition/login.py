import mysql.connector
import subprocess
from tkinter import *
from tkinter import ttk
from PIL import Image, ImageTk
from tkinter import messagebox

class Login_Window:
    def __init__(self, root):
        self.root = root
        self.root.title("Login")
        self.root.geometry("1550x800+0+0")

        self.bg = ImageTk.PhotoImage(file=r"C:\Users\lenovo\Desktop\FaceRecognition\background.jpeg")
        lbl_bg = Label(self.root, image=self.bg)
        lbl_bg.place(x=0, y=0, relwidth=1, relheight=1)

        frame = Frame(self.root, bg="black")
        frame.place(x=610, y=170, width=340, height=450)

        img1 = Image.open(r"C:\Users\lenovo\Desktop\FaceRecognition\login.png")
        img1 = img1.resize((100, 100), Image.ANTIALIAS)
        self.photoimage1 = ImageTk.PhotoImage(img1)
        lblimg1 = Label(image=self.photoimage1, bg="black", borderwidth=0)
        lblimg1.place(x=730, y=175, width=100, height=100)

        get_str = Label(frame, text="Get Started", font=("times new roman", 20, "bold"), fg="white", bg="black")
        get_str.place(x=95, y=100)

        # label
        username = lbl = Label(frame, text="Username", font=("times new roman", 15, "bold"), fg="white", bg="black")
        username.place(x=70, y=155)

        self.txtuser = ttk.Entry(frame, font=("times new roman", 15, "bold"))
        self.txtuser.place(x=48, y=180, width=270)

        password = lbl = Label(frame, text="Password", font=("times new roman", 15, "bold"), fg="white", bg="black")
        password.place(x=70, y=225)

        self.txtpass = ttk.Entry(frame, font=("times new roman", 15, "bold"))
        self.txtpass.place(x=40, y=250, width=270)

        # ======Icon Images
        img2 = Image.open(r"C:\Users\lenovo\Desktop\FaceRecognition\username.png")
        img2 = img2.resize((25, 25), Image.ANTIALIAS)
        self.photoimage2 = ImageTk.PhotoImage(img2)
        lblimg1 = Label(image=self.photoimage2, bg="black", borderwidth=0)
        lblimg1.place(x=650, y=323, width=25, height=25)

        img3 = Image.open(r"c:\Users\lenovo\Desktop\FaceRecognition\password.png")
        img3 = img3.resize((25, 25), Image.ANTIALIAS)
        self.photoimage3 = ImageTk.PhotoImage(img3)
        lblimg1 = Label(image=self.photoimage3, bg="black", borderwidth=0)
        lblimg1.place(x=655, y=395, width=25, height=25)

        loginbtn = Button(frame, command=self.login, text="Login", font=("times new roman", 15, "bold"), bd=3,
                          relief=RIDGE, fg="white", bg="red", activeforeground="white", activebackground="red")
        loginbtn.place(x=110, y=300, width=120, height=35)

        registerbtn = Button(frame, text="Register", command=self.register_page, font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        registerbtn.place(x=15, y=350, width=160)

        forgotpwbtn = Button(frame, text="Forgot Password", font=("times new roman", 10, "bold"), bd=3, relief=RIDGE,
                          fg="white", bg="black", activeforeground="white", activebackground="black")
        forgotpwbtn.place(x=10, y=370, width=160)

    def login(self):
        if self.txtuser.get() == "" or self.txtpass.get() == "":
            messagebox.showerror("Error", "All fields required")
        else:
            try:
                connection = mysql.connector.connect(
                    host="localhost",
                    user="root",
                    password="",
                    database="register"
                )
                cursor = connection.cursor()
                query = "SELECT * FROM registerai WHERE email = %s AND password = %s"
                values = (self.txtuser.get(), self.txtpass.get())
                cursor.execute(query, values)
                result = cursor.fetchone()
                if result is not None:
                    subprocess.Popen(['python', r"C:\Users\lenovo\Desktop\FaceRecognition\mainfile.py"])
                else:
                    messagebox.showerror("Invalid", "Username or Password")
                connection.close()
            except mysql.connector.Error as error:
                messagebox.showerror("Error", f"Failed to connect to the database: {error}")
    
    def register_page(self):
        # Open the register page or perform any other actions you want
        subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\register.py'])



if __name__ == "__main__":
    root = Tk()
    app = Login_Window(root)
    root.mainloop()
