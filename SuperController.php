<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiddenDimension
 * Date: 9/5/2018
 * Time: 3:31 PM
 */


session_start();

$serveraddr = "localhost";
$username = "root";
$password = "";
$dbname = "elearning";


//send news in json
function getLatestNews()
{

    $news_api = "https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=46a06f8b7bae4cbe89a4b1a7b0243a28";

    $html = file_get_contents($news_api);
    echo $html;
}


function addComment()
{

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;


    $isPosted = 0;

    $articleName = $_POST['articleName'];

    $comment = $_POST["comment"];

    $uid = $_SESSION["userid"];


    if(isset($_SESSION["userid"])) {

        $query = "INSERT INTO `studentcommentsarticle` (`sid`, `articleName`, `comment`, `date`) VALUES ('$uid', '$articleName', '$comment', NOW());";

        if (isset($_SESSION["isTeacher"])) {


            $query = "INSERT INTO `teachercommentsarticle` (`tid`, `articleName`, `comment`, `date`) VALUES ('$uid', '$articleName', '$comment', NOW());";

        }


        try {
            $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            try {
                $pdostmt = $conn->prepare($query);
                $isPosted = $pdostmt->execute();


            } catch (PDOException $ex) {
                echo $ex;
            }


        } catch (Exception $ex) {
            echo $ex;
        }


    }

    return $isPosted;


}

function postArticle()
{

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;


    $name = $_POST['name'];
    $about = $_POST['about'];
    $type = $_POST['type'];
    $tid = $_SESSION["userid"];


    $isPosted = 0;

    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {
            $pdostmt = $conn->prepare("INSERT INTO `article` (`name`, `about`, `type`, `views`, `creationDate`, `tid`) VALUES ('$name', '$about', '$type', '0', NOW(), '$tid');");
            $isPosted = $pdostmt->execute();


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $isPosted;


}


function getComments($articleName)
{

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

//    $uname = htmlspecialchars($_POST["username"]);
//    $upass = htmlspecialchars($_POST["password"]);
//    $utype = htmlspecialchars($_POST["usertype"]);
//    $ut = htmlspecialchars($_POST["ut"]);
//
//    $email =  htmlspecialchars($_POST["email"]);
//    $phone =  htmlspecialchars($_POST["phone"]);
//    $gender =  htmlspecialchars($_POST["gender"]);
//
//    $id =  htmlspecialchars($_POST["id"]);
//
//    $isUser = false;


    $data = "";


    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//        "select comment , name , articleName , date  from  (
//            (SELECT * FROM teachercommentsarticle NATURAL join teacher )
//             UNION
//             (SELECT * FROM studentcommentsarticle NATURAL JOIN student)
//             ) as t1 where t1.articleName like '$articleName' ORDER by date ASC"

        try {
            $pdostmt = $conn->prepare("select comment , name , articleName , date  from  (
(SELECT comment , name , articleName , date FROM teachercommentsarticle INNER join teacher on teachercommentsarticle.tid=teacher.id )
             
UNION
(SELECT comment , name , articleName , date FROM studentcommentsarticle INNER JOIN student on studentcommentsarticle.sid=student.id )
             ) as t1 where t1.articleName like '$articleName' ORDER by date ASC");
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {


                $div = $row[1] . " :" . $row[0] . "<br>";


                $data = $data . $div;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return "<p class='card-body'>" . $data . "</p>";

}

function getSuggestion() {

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

//    $uname = htmlspecialchars($_POST["username"]);
//    $upass = htmlspecialchars($_POST["password"]);
//    $utype = htmlspecialchars($_POST["usertype"]);
//    $ut = htmlspecialchars($_POST["ut"]);
//
//    $email =  htmlspecialchars($_POST["email"]);
//    $phone =  htmlspecialchars($_POST["phone"]);
//    $gender =  htmlspecialchars($_POST["gender"]);
//
//    $id =  htmlspecialchars($_POST["id"]);
//
//    $isUser = false;


    $data = "";


    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {
            $pdostmt = $conn->prepare("SELECT * FROM `article` ");
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {


                $div = "<option value='$row[0]' >";


                $data = $data . $div;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $data;



}


function getRecentPosts()
{


    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

//    $uname = htmlspecialchars($_POST["username"]);
//    $upass = htmlspecialchars($_POST["password"]);
//    $utype = htmlspecialchars($_POST["usertype"]);
//    $ut = htmlspecialchars($_POST["ut"]);
//
//    $email =  htmlspecialchars($_POST["email"]);
//    $phone =  htmlspecialchars($_POST["phone"]);
//    $gender =  htmlspecialchars($_POST["gender"]);
//
//    $id =  htmlspecialchars($_POST["id"]);
//
//    $isUser = false;


    $data = "";


    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {
            $pdostmt = $conn->prepare("SELECT * FROM `article` ORDER by creationDate DESC LIMIT 5");
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {


                $div = " <div id=\"$row[0]\">
                    <div class=\"card\">
                        <div>
                            <h4 class=\"card-header\">$row[0]</h4>
                            <p class=\"card-body\">
                              $row[1]
                            </p>
                        </div>
                    </div>

                    <div class=\"card\">
                        <div>
                        
                       " . getComments($row[0]) . " 
                            <p class=\"card-body\">
                                <textarea id=\"post\" style=\"width: 100%;\" class=\"text-info d-inline-block\" type=\"text\"
                                          placeholder=\"Comments will be here\"> </textarea>
                                <button class=\"btn-primary\" onclick=\"addComment('$row[0]')\">Comment</button>
                            </p>
                        </div>
                    </div>

                </div>";


                $data = $data . $div;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $data;


}


function trendingPosts()
{


    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

//    $uname = htmlspecialchars($_POST["username"]);
//    $upass = htmlspecialchars($_POST["password"]);
//    $utype = htmlspecialchars($_POST["usertype"]);
//    $ut = htmlspecialchars($_POST["ut"]);
//
//    $email =  htmlspecialchars($_POST["email"]);
//    $phone =  htmlspecialchars($_POST["phone"]);
//    $gender =  htmlspecialchars($_POST["gender"]);
//
//    $id =  htmlspecialchars($_POST["id"]);
//
//    $isUser = false;


    $data = "";


    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {
            $pdostmt = $conn->prepare("SELECT *   from  article where name IN (SELECT DISTINCT articleName from  ((
    select articleName , COUNT(*) as t from teachercommentsarticle GROUP BY articleName) 
                 UNION    (
    select articleName , COUNT(*) as t from studentcommentsarticle GROUP BY articleName) )
    
    as y  ORDER by y.t DESC )");
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {


                $div = " <div id=\"$row[0]\">
                    <div class=\"card\">
                        <div>
                            <h4 class=\"card-header\">$row[0]</h4>
                            <p class=\"card-body\">
                              $row[1]
                            </p>
                        </div>
                    </div>

                    <div class=\"card\">
                        <div>
                        
                       " . getComments($row[0]) . " 
                            <p class=\"card-body\">
                                <textarea id=\"post\" style=\"width: 100%;\" class=\"text-info d-inline-block\" type=\"text\"
                                          placeholder=\"Comments will be here\"> </textarea>
                                <button class=\"btn-primary\" onclick=\"addComment('$row[0]')\">Comment</button>
                            </p>
                        </div>
                    </div>

                </div>";


                $data = $data . $div;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $data;


}


function search()
{


    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

//    $uname = htmlspecialchars($_POST["username"]);
//    $upass = htmlspecialchars($_POST["password"]);
//    $utype = htmlspecialchars($_POST["usertype"]);
//    $ut = htmlspecialchars($_POST["ut"]);
//
//    $email =  htmlspecialchars($_POST["email"]);
//    $phone =  htmlspecialchars($_POST["phone"]);
//    $gender =  htmlspecialchars($_POST["gender"]);
//
//    $id =  htmlspecialchars($_POST["id"]);
//
//    $isUser = false;


    $data = "";

    $query = $_POST["query"];



    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {
            $pdostmt = $conn->prepare("SELECT *   from  article where name like '$query'");
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {


                $div = " <div id=\"$row[0]\">
                    <div class=\"card\">
                        <div>
                            <h4 class=\"card-header\">$row[0]</h4>
                            <p class=\"card-body\">
                              $row[1]
                            </p>
                        </div>
                    </div>

                    <div class=\"card\">
                        <div>
                        
                       " . getComments($row[0]) . " 
                            <p class=\"card-body\">
                                <textarea id=\"post\" style=\"width: 100%;\" class=\"text-info d-inline-block\" type=\"text\"
                                          placeholder=\"Comments will be here\"> </textarea>
                                <button class=\"btn-primary\" onclick=\"addComment('$row[0]')\">Comment</button>
                            </p>
                        </div>
                    </div>

                </div>";


                $data = $data . $div;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $data;


}


function showProfile()
{


    global $serveraddr;
    global $username;
    global $password;
    global $dbname;




       $data = "";





    try {
        $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        try {


            $uid= $_SESSION['userid'];

            //echo $uid;

            $query = "SELECT * FROM `student` WHERE id=$uid";

            if(isset($_SESSION['isTeacher'])){

                $query = "SELECT * FROM `teacher` WHERE id=$uid";
            }


            $pdostmt = $conn->prepare($query);
            $pdostmt->execute();

            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);


            foreach ($table as $row) {





                $data = "  <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content text-center\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title \" id=\"\">Profile</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>


            </div>


            <div class=\"modal-body\">


                <div class=\"col-12 text-center\">


                    <!--<h2 class=\"bg-primary text-white rounded\">Log in</h2>-->

                    <div class=\"card\"
                         style=\"width: 100%; padding-bottom: 20px; padding-left: 20px; padding-right: 20px; padding-top: 20px\">


                        <div>

                            <div>
                                <div>

                                    <div class=\"form-group\">
                                      <input class=\"form-control-lg\" type=\"text\" value='$row[1]' id=\"pname\" placeholder=\"Name\">
                                    </div>
                                    <div class=\"form-group\">
                                      <input class=\"form-control-lg\" type=\"number\" id=\"pid\" value='$row[0]' maxlength=\"2\" size=\"2\"
                                               placeholder=\"ID\">
                                    </div>
                                    <div class=\"form-group\">
                                       <input class=\"form-control-lg\"  list=\"ut\" type=\"text\" value='$row[5]' id=\"pusertype\"
                                               placeholder=\"User type\"
                                        >


                                        <datalist id=\"put\">
                                            <option value=\"Undergrad\">
                                            <option value=\"Grad\">
                                            <option value=\"Lecturer\">
                                            <option value=\"Professor\">

                                        </datalist>

                                    </div>
                                    <div class=\"form-group\">

                                      <input class=\"form-control-lg\" type=\"email\" id=\"pemail\" value='$row[2]' placeholder=\"Email\">
                                    </div>
                                    <div class=\"form-group\">
                                      <input class=\"form-control-lg\" id=\"pphone\" value='$row[4]' placeholder=\"phone\">
                                    </div>
                                    <div class=\"form-group\">
                                     <input class=\"form-control-lg\" type=\"password\" value='$row[3]' id=\"ppassword\"
                                               placeholder=\"password\">
                                    </div>
                                    <div class=\"form-group\" > 

                                        <select id=\"pgender\" class=\"form-control-lg\" onchange=\"\">
                                           
                                            <option>$row[6]</option>
                                           

                                        </select>
                                    </div>

                                  

                                    <br><label class=\"text-danger\" id=\"perrorInSigningUp\"></label>


                                  
                                </div>


                            </div>
                        </div>


                    </div>

                </div>
            </div>


            <!--<div class=\"modal-footer\">-->
            <!--<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>-->
            <!--<button type=\"button\" class=\"btn btn-primary\">Save changes</button>-->
            <!--</div>-->
        </div>
    </div>";

                break;


            }


        } catch (PDOException $ex) {
            echo $ex;
        }


    } catch (Exception $ex) {
        echo $ex;
    }


    return $data;


}


function checkSession()
{

    if (isset($_SESSION["userid"]))
        return true;
    return false;
}

function signup()
{

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

    $uname = htmlspecialchars($_POST["username"]);
    $upass = htmlspecialchars($_POST["password"]);
    $utype = htmlspecialchars($_POST["usertype"]);
    $ut = htmlspecialchars($_POST["ut"]);

    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $gender = htmlspecialchars($_POST["gender"]);

    $id = htmlspecialchars($_POST["id"]);

    $isUser = false;


    if ($utype == "student") {

        try {
            $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            try {
                $pdostmt = $conn->prepare("INSERT INTO `student` (`id`, `name`, `email`, `password`, `phone`, `type`, `gender`, `joiningDate`) VALUES ('$id', '$uname', '$email', '$upass', '$phone', '$ut', '$gender', NOW() );");
                $isUser = $pdostmt->execute();


            } catch (PDOException $ex) {
                echo $ex;
            }


        } catch (Exception $ex) {
            echo $ex;
        }


    } elseif ($utype == "teacher") {


        try {
            $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            try {
                $pdostmt = $conn->prepare("INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `phone`, `type`, `gender`, `joiningDate`) VALUES ('$id', '$uname', '$email', '$upass', '$phone', '$ut', '$gender', NOW());");
                $isUser = $pdostmt->execute();


            } catch (PDOException $ex) {
                echo $ex;
            }


        } catch (Exception $ex) {
            echo $ex;
        }

    }


    return $isUser;


}

function login()
{

    global $serveraddr;
    global $username;
    global $password;
    global $dbname;

    $uname = htmlspecialchars($_POST["username"]);
    $upass = htmlspecialchars($_POST["password"]);
    $utype = htmlspecialchars($_POST["usertype"]);

    $isUser = false;


    if ($utype == "student") {

        try {
            $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            try {
                $pdostmt = $conn->prepare("SELECT * FROM `student` WHERE id=$uname AND password like '$upass'");
                $pdostmt->execute();
                $res = $pdostmt->fetchAll(PDO::FETCH_NUM);


                if (!empty($res)) {
                    $len = $res[0][0];  ///here $len contains the max assigned id to users, so that we can assign the next value(i.e. +1) to the new user


                    // echo "user from data base " . $len;


                    if (isset($len)) {
                        // header("Location: http://localhost:81/projects/011142002/home.php"); /* Redirect browser */
                        $_SESSION["userid"] = $len;
                        $_SESSION["username"] = $res[0][1];

                        $isUser = true;
                        //  exit();
                    }


                } else {

                    echo "Id or Password is wrong.";
                }


            } catch (PDOException $ex) {
                echo $ex;
            }


        } catch (Exception $ex) {
            echo $ex;
        }


    } elseif ($utype == "teacher") {


        try {
            $conn = new PDO("mysql:host=$serveraddr;dbname=$dbname", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            try {
                $pdostmt = $conn->prepare("SELECT * FROM `teacher` WHERE id=$uname AND password like '$upass'");
                $pdostmt->execute();
                $res = $pdostmt->fetchAll(PDO::FETCH_NUM);


                if (!empty($res)) {
                    $len = $res[0][0];  ///here $len contains the max assigned id to users, so that we can assign the next value(i.e. +1) to the new user


                    // echo "user from data base " . $len;


                    if (isset($len)) {
                        // header("Location: http://localhost:81/projects/011142002/home.php"); /* Redirect browser */
                        $_SESSION["userid"] = $len;
                        $_SESSION["username"] = $res[0][1];
                        $_SESSION["isTeacher"] = true;
                        $isUser = true;
                        //  exit();
                    }


                } else {

                    echo "Id or Password is wrong.";
                }


            } catch (PDOException $ex) {
                echo $ex;
            }


        } catch (Exception $ex) {
            echo $ex;
        }


    }


    return $isUser;

}


function logout()
{

    session_destroy();
}


function getUserName()
{
    if (isset($_SESSION["username"]))
        return $_SESSION["username"];
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST["state"])) {
        $state = $_POST["state"];


        switch ($state) {


            case "login":
                echo login();
                break;


            case "signup":
                echo signup();
                break;


            case "logout":
                echo logout();
                break;

            case "session":
                echo checkSession();
                break;

            case "getusername":
                echo getUserName();
                break;


            case "getnews":
                echo getLatestNews();
                break;


            case "recentposts":
                echo getRecentPosts();
                break;

            case "postArticle":

                echo postArticle();
                break;


            case "addComment":

                echo addComment();
                break;


            case "trending":
                echo trendingPosts();
                break;


            case "suggestion":
                echo getSuggestion();
                break;

            case "search":

                echo search();
                break;

            case "show_profile":

                echo showProfile();
                break;

            case "checkFaculty":
                echo isset($_SESSION['isTeacher']);
                break;

        }


    }


}


?>