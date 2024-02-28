<?php
    include ('pdo.php');
    session_start();


//FOR REGISTERING USER DETAILS

if(isset($_POST['submit'])){ // getting the name of a button and its like on click
   
  $name = $_POST['name']; //getting name field from user
 $email = $_POST['email']; //getting email 
  $password = $_POST['password']; //getting password

  $query ="INSERT INTO user (name, email, password)VALUES(:name,:email,:password)"; //inserting query into database
  $statements =$pddo->prepare($query); //preparing query
 $con = [
  ':name' => $name,
  ':email' => $email,
  ':password' => $password
 ]; //getting user details
   $statements->execute($con); //executing the details
   include('login.php'); //taking into login page after submitting the details

} 


// GETTING LOG IN BY THE USERS WHO IS ALREADY REGISTERED
if(isset($_POST['button'])){ // getting the name of a button and its like on click
  
  $email = $_POST['email']; //getting email inputted by users 
  $password = $_POST['password']; //getting password


  $query1 ="SELECT * FROM user WHERE  email =:email AND password =:password"; //selecting from user tabel 
  $select = $pddo->prepare($query1); // preparing the query
 $criteria = [
  'email'=>$email,
  'password'=>$password]; //comparing the users inputted datas and the registered datas
  $select->execute($criteria); //executing the code
  $select->fetch(); //fetching
  if($select->rowCount()>0){ // if there is the exact data
     $_SESSION['logged in']=true; //it will display logged in
     include('index2.php'); // and take it to the users page
  }
  else {
    $_SESSION['logged in fail']=true; //else it will display logged in fail
    include('login.php'); // and stays in login page
  }
}






// FOR INSERTING ARTICLES INTO THE DATABASE:

if(isset($_POST['submit'])){ //while clicking submit button 
   
  $title = $_POST['title']; //calling value of input field
  $category = $_POST['category']; //calling value of input field
  $textarea = $_POST['textarea']; //calling value of input field

  $query3 ="INSERT INTO article (title, category, textarea)VALUES(:title,:category,:textarea)"; //query for inserting data into database
  $statements =$pddo->prepare($query3); //preparing the query
  $con = [
    ':title' => $title,
    ':category' => $category,
    ':textarea' => $textarea
  ]; //putting the value given by users into input field 
  $statements->execute($con); //executing the datas given by users
  include('index.php'); //after submitting datas it will take into index.php page which is home page
} 



//FOR EDITING ARTICLES
if(isset($_POST['edit'])){ //while clicking on edit link 

    
  $id = $_POST['article_id']; //getting article id
  $title = $_POST['title']; //getting article title
  $category = $_POST['category']; //getting article category
   $textarea = $_POST['textarea']; // getting content

   try{ //throwing exception
      
  $query ="UPDATE article SET title=:title, category=:category, textarea=:textarea WHERE id=:article_id"; //query for updatting 
   $statement =$pddo->prepare($query); //preparing query
  $data = [
      'title' => $title, 
      'category' => $category, 
      'textarea' => $textarea,
      'article_id' => $id  
    ];//taking the new values
    $query_execute = $statement->execute($data); //executing the new values

    if($query_execute){ //if executed 
      $_SESSION['message'] = "Edited Successfully"; // shows message editted successfully
      header('Location: adminArticle.php'); // and takes it to admin home page
      exit(0);
    }
    else{
      $_SESSION['message'] = "Not Updated Successfully"; // else displays not updated successfully
      header('Location: editArticle.php'); // and stays on the same page
      exit(0);
    }
  }
   catch(PDOException $e){ // catching the exception 
      echo $e->getMessage(); // and getting the messages
   }

}   

//FOR DELETING ARTICLE
    if(isset($_POST['delete'])){ //while clicking submit button 

    
        $id = $_POST['delete']; // takes the id
        
        try{    //throws exception
        $query ="DELETE FROM article WHERE id=:id"; //query for deleting
         $statement =$pddo->prepare($query); //prepares the query
        $data = [
            ':id' => $id  
          ]; // checks the id if there is or not
          $query_execute = $statement->execute($data); // then executes the code

          if($query_execute){ //if executed 
            $_SESSION['message'] = "Deleted Successfully"; //diplays message deleted successfully
            header('Location: adminArticle.php'); // and takes it to admin home page
            exit(0);
          }
          else{
            $_SESSION['message'] = "Not Deleted Sucessfully"; // if not executed
            header('Location: editArticle.php'); // remains on the same page
            exit(0);
          }
         }
         catch(PDOException $e){ // catching exceptions
            echo $e->getMessage(); // gets message
         }
    
    } 


//FOR ADDING ADMIN
    if(isset($_POST['add'])){ //on the click of add button
   
      $name = $_POST['name']; //gets name
     $email = $_POST['email']; // gets email
      $password = $_POST['password']; // gets password which have been entered
      $query ="INSERT INTO admin (name, email, password)VALUES(:name,:email,:password)"; // query for inserting into database
      $statements =$pddo->prepare($query); // and prpare the query
     $con = [
      ':name' => $name,
      ':email' => $email,
      ':password' => $password
     ]; //check the datas
       $statements->execute($con); //executes the datas
       include('login.php'); // after that takes it to the login page
    
    } 




    //FOR EDITING ADMIN
if(isset($_POST['editAdmin'])){ //while clicking submit button 

    
  $id = $_POST['admin_id']; //gets admin id
  $name = $_POST['name']; // gets name
  $email = $_POST['email']; // gets email
   $password = $_POST['password']; // gets password

   try{ //and throws exception
      
  $query ="UPDATE admin SET name=:name, email=:email, password=:password WHERE id=:admin_id LIMIT 1"; // query for updatting the datas
  $statement =$pddo->prepare($query); // prepares the query
  $data = [
      'name' => $name, 
      'email' => $email, 
      'password' => $password,
      'admin_id' => $id  
    ]; // checks the datas entered
    $query_execute = $statement->execute($data); // executes the query
 
    if($query_execute){ // if executed
      $_SESSION['message'] = "Edited Successfully"; // displays the message edited successfully
      header('Location: login.php'); // and takes to the login page
      exit(0);
    }
    else{
      $_SESSION['message'] = "Not Updated Successfully"; // else shows not updated successfully message
      header('Location: editArticle.php'); // and stays on the same page
      exit(0);
    }
   }
   catch(PDOException $e){ // catching exceptions
      echo $e->getMessage(); // getting message
   }

}

    //FOR DELETING ADMIN
    if(isset($_POST['delete_admin'])){ //while clicking submit button 

    
      $id = $_POST['delete_admin']; // gets admin id 
       try{ // throws exception
          
      $query ="DELETE FROM admin WHERE id=:admin_id"; // query for deleting
       $statement =$pddo->prepare($query); // executes the query
      $data = [
          'admin_id' => $id  
        ]; // checking the id 
        $query_execute = $statement->execute($data); // executing the code

        if($query_execute){ // if executed 
          $_SESSION['message'] = "Deleted Successfully"; // displays message deleted successfully 
          header('Location: deleteAdmin.php'); // and takes it to delete article page 
          exit(0);
        }
        else{
          $_SESSION['message'] = "Not Deleted Successfully"; // if not shows not deleted successfully message
          header('Location: deleteAdmin.php'); // and remains on the same page
          exit(0);
        }
       }
       catch(PDOException $e){ // catching exceptions
          echo $e->getMessage(); //getting message
       }
  
  } 




     





// if(isset($_POST['delete_category'])){

    
//   $id = $_POST['delete_category'];
//    try{
      
//   $query ="DELETE FROM newcategory WHERE id=:category_id";
//   // $statement =$pddo->prepare($query);
//   $data = [
//       'category_id' => $id  
//     ];
//     $query_execute = $statement->execute($data);

//     if($query_execute){
//       $_SESSION['message'] = "Deleted Sucessfully";
//       header('Location: adminArticle.php');
//       exit(0);
//     }
//     else{
//       $_SESSION['message'] = "Not Deleted Sucessfully";
//       header('Location: editArticle.php');
//       exit(0);
//     }
//    }
//    catch(PDOException $e){
//       echo $e->getMessage();
//    }

// } 














//FOR ADDING CATEGORIES

if(isset($_POST['addcategory'])){
  
  $category = $_POST['newcategory'];


  $query3 ="INSERT INTO category (name)VALUES(:category)";
  $statements =$pddo->prepare($query3);
  $statements->bindparam(':category',$category);
  $statements->execute();
  include('manageCategories.php');
} 

//FOR EDITING CATEGORY


    
    

  






if(isset($_POST['editCategory'])){

    
  $id = $_POST['category_id'];
  $category = $_POST['category'];
 

   try{
      
  $query ="UPDATE category SET name=:category WHERE category_id=:category_id";
   $statement =$pddo->prepare($query);
  $data = [
      'name' => $category,
      'category_id' => $id  
    ];
    $query_execute = $statement->execute($data);

    if($query_execute){
      $_SESSION['message'] = "Edited Sucessfully";
      header('Location: editCategories.php');
      exit(0);
    }
    else{
      $_SESSION['message'] = "Not Updated Sucessfully";
      header('Location: editCategories.php');
      exit(0);
    }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }

  }





?>