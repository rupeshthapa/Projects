import mysql.connector
import subprocess
from tkinter import *
from tkinter import ttk
from PIL import Image, ImageTk
from tkinter import messagebox

class Register:
    def __init__(self, root):
        self.root = root
        self.root.title("Register")
        self.root.geometry("1600x900+0+0")

        self.var_fname = StringVar()
        self.var_lname = StringVar()
        self.var_contact = StringVar()
        self.var_email = StringVar()
        self.var_selectQ = StringVar()
        self.var_selectA = StringVar()
        self.var_pass = StringVar()
        self.var_confpass = StringVar()

        self.bg = ImageTk.PhotoImage(file=r"c:\Users\lenovo\Desktop\FaceRecognition\register.jpg")
        bg_lbl = Label(self.root, image=self.bg)
        bg_lbl.place(x=0, y=0, relwidth=1, relheight=1)

        frame = Frame(self.root, bg="white")
        frame.place(x=520, y=100, width=800, height=550)

        register_lbl = Label(frame, text="Register Here", font=("times new roman", 25, "bold"), fg="darkgreen", bg="white")
        register_lbl.place(x=20, y=20)

        fname = Label(frame, text="First Name", font=("times new roman", 15, "bold"), bg="white")
        fname.place(x=50, y=100)

        self.txt_fname = ttk.Entry(frame, textvariable=self.var_fname, font=("times new roman", 15))
        self.txt_fname.place(x=50, y=130, width=250)

        l_name = Label(frame, text="Last Name", font=("times new roman", 15, "bold"), bg="white")
        l_name.place(x=370, y=100)

        self.txt_lname = ttk.Entry(frame, textvariable=self.var_lname, font=("times new roman", 15))
        self.txt_lname.place(x=370, y=130, width=250)

        contact = Label(frame, text="Contact", font=("times new roman", 15, "bold"), bg="white")
        contact.place(x=50, y=170)

        self.txt_contact = ttk.Entry(frame, textvariable=self.var_contact, font=("times new roman", 15))
        self.txt_contact.place(x=50, y=200, width=250)

        email = Label(frame, text="Email", font=("times new roman", 15, "bold"), bg="white")
        email.place(x=370, y=170)

        self.txt_email = ttk.Entry(frame, textvariable=self.var_email, font=("times new roman", 15))
        self.txt_email.place(x=370, y=200, width=250)

        security_Q = Label(frame, text="Select Security Questions", font=("times new roman", 15, "bold"), bg="white")
        security_Q.place(x=50, y=240)

        self.combo_security_Q = ttk.Combobox(frame, textvariable=self.var_selectQ, font=("times new roman", 15, "bold"), state="readonly")
        self.combo_security_Q["values"] = ("Select", "Your Birth Place", "Your Girlfriend Name", "Your Pet Name")
        self.combo_security_Q.place(x=50, y=270, width=250)
        self.combo_security_Q.current(0)

        security_A = Label(frame, text="Security Answer", font=("times new roman", 15, "bold"), bg="white")
        security_A.place(x=370, y=240)

        self.txt_security = ttk.Entry(frame, textvariable=self.var_selectA, font=("times new roman", 15))
        self.txt_security.place(x=370, y=270, width=250)

        pswd = Label(frame, text="Password", font=("times new roman", 15, "bold"), bg="white")
        pswd.place(x=50, y=310)

        self.txt_pswd = ttk.Entry(frame, textvariable=self.var_pass, font=("times new roman", 15),show="*")
        self.txt_pswd.place(x=50, y=340, width=250)

        confirm_pswd = Label(frame, text="Confirm Password", font=("times new roman", 15, "bold"), bg="white")
        confirm_pswd.place(x=370, y=310)

        self.txt_confirm_pswd = ttk.Entry(frame, textvariable=self.var_confpass, font=("times new roman", 15),show="*")
        self.txt_confirm_pswd.place(x=370, y=340, width=250)

        self.var_check = IntVar()
        checkbtn = Checkbutton(frame, variable=self.var_check, text="I Agree to the Terms & Conditions", font=("times new roman", 15, "bold"), onvalue=1, offvalue=0)
        checkbtn.place(x=50, y=380)

        img = Image.open(r"c:\Users\lenovo\Desktop\FaceRecognition\registerbtn.jpg")
        img = img.resize((100, 50), Image.ANTIALIAS)
        self.photoimage = ImageTk.PhotoImage(img)
        b1 = Button(frame, image=self.photoimage, command=self.register_data, borderwidth=0, cursor="hand2")
        b1.place(x=10, y=420, width=300)
        
        def open_login_file():
    # Use the subprocess module to open the login.py file with the default associated program
            subprocess.Popen(['python', r'C:\Users\lenovo\Desktop\FaceRecognition\login.py'])

        img1 = Image.open(r"c:\Users\lenovo\Desktop\FaceRecognition\loginbtn.jpeg")
        img1 = img1.resize((100, 50), Image.ANTIALIAS)
        self.photoimage1 = ImageTk.PhotoImage(img1)
        b2 = Button(frame, image=self.photoimage1, borderwidth=0, cursor="hand2", command=open_login_file)
        b2.place(x=330, y=420, width=300)

    def register_data(self):
        if self.var_fname.get() == "" or self.var_email.get() == "" or self.var_selectQ.get() == "Select":
            messagebox.showerror("Error", "All fields are required")
        elif self.var_pass.get() != self.var_confpass.get():
            messagebox.showerror("Error", "Password and confirm password must be the same")
        elif self.var_check.get() == 0:
            messagebox.showerror("Error", "Please agree to our terms and conditions")
        else:
            try:
                # Establish a connection to the database
                connection = mysql.connector.connect(
                    host="localhost",
                    user="root",
                    password="",
                    database="register"
                )

                # Create a cursor object to execute SQL queries
                cursor = connection.cursor()

                # Prepare the INSERT query
                query = "INSERT INTO registerai (fname, lname, contact, email, securityq, securitya, password, cpassword) " \
                        "VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
                values = (
                    self.var_fname.get(),
                    self.var_lname.get(),
                    self.var_contact.get(),
                    self.var_email.get(),
                    self.var_selectQ.get(),
                    self.var_selectA.get(),
                    self.var_pass.get(),
                    self.var_confpass.get()
                )

                # Execute the INSERT query
                cursor.execute(query, values)

                # Commit the changes to the database
                connection.commit()

                # Close the cursor and connection
                cursor.close()
                connection.close()

                messagebox.showinfo("Success", "Data inserted successfully!")
            except mysql.connector.Error as error:
                messagebox.showerror("Error", f"Failed to insert data: {error}")
                
                
   

if __name__ == "__main__":
    root = Tk()
    app = Register(root)
    root.mainloop()
