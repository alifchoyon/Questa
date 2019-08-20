
function makeCard( header , news , url , urlToImage ){

    var x = '<div class="card">\n' +
        '\n' +
        '\n' +
        '                <div>\n' +
        '\n' +
        '                    <h4 class="card-header"><a href="'+url+'">'+header+'</a> </h4>\n' +
        '\n' +          '<img class="card-img-top" src="'+urlToImage+'">  </img>'+
        '\n' +
        '                    <br>\n' +
        '\n' +
        '                    <p class="card-body">'+news+'</p>\n' +
        '\n' +
        '                </div>\n' +
        '\n' +
        '\n' +
        '            </div>';

    return x;
}

function showNews(){

    var news_div = document.getElementById("div2");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //  alert(this.responseText);

            if (this.responseText.length > 0) {




                var news = JSON.parse(this.responseText)
                var articles = news['articles']


                var tbuffer ="";

                for(var i =0 ; i<articles.length ; i++){

                   // alert(articles[i]["title"]);

                    tbuffer+= makeCard(articles[i]["title"],articles[i]["description"] ,articles[i]["url"],articles[i]["urlToImage"]);

                }


                news_div.innerHTML= tbuffer.toString();


            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=getnews");

}

function signup() {

    var name = document.getElementById("name").value;
    var id = document.getElementById("id").value;
    var email = document.getElementById("email").value;
    var ut = document.getElementById("usertype").value;

    var phone = document.getElementById("phone").value;
    var pass = document.getElementById("password").value;
    var gen = document.getElementById("gender").value;

    var iamt = document.getElementById("iamt").checked;


  //  alert(name + id + email + ut + phone + pass + gen + iamt);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

           // alert(this.responseText);

            if (this.responseText == 1) {

                var ldiv = document.getElementById("message");


                ldiv.innerHTML = "<div class=\"alert alert-success text-center\" role=\"alert\">\n" +
                    "  Sign up was successful !\n" +
                    "</div>";


                //   document.getElementById("login").style.display="none";
                $('#signup').modal('hide');
            }
            else{

                //errorInSigningUp

                document.getElementById("errorInSigningUp").innerHTML='Something went Wrong. Try again later.';

            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    if (iamt) {
        xhttp.send("username=" + name + "&id=" + id + "&email=" + email + "&ut=" + ut
            + "&phone=" + phone
            + "&password=" + pass + "&gender=" + gen + "&state=signup&usertype=teacher");

    }
    else {
        xhttp.send("username=" + name + "&id=" + id + "&email=" + email + "&ut=" + ut
            + "&phone=" + phone
            + "&password=" + pass + "&gender=" + gen + "&state=signup&usertype=student");

    }


}


function getUsername() {



    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

          //  alert(this.responseText);

            if (this.responseText.length > 0) {

                var ldiv = document.getElementById("dropdownMenuLink");


                ldiv.innerHTML = 'hi ,'+this.responseText;


                //   document.getElementById("login").style.display="none";
                $('#signup').modal('hide');
            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


        xhttp.send("state=getusername");




}
function login() {

    var un = document.getElementById("txtUser");
    var pass = document.getElementById("txtPassword");


   // alert(un.value+pass.value);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

           //   alert(this.responseText);

            if (this.responseText == 1) {

                var ldiv = document.getElementById("options");

                // ldiv.innerHTML = "<li class=\"nav-item \">\n" +
                //     "\n" +
                //     "                    <a class=\"nav-link\" href=\"#\" onclick='logout()' data-toggle=\"modal\" data-target=\"#logout\">\n" +
                //     "                        Log Out\n" +
                //     "                    </a>\n" +
                //     "                </li>";


                ldiv.innerHTML ='<div class="form-inline my-2 my-lg-0">\n' +
                    '\n' +
                    '            <div class="collapse navbar-collapse">\n' +
                    '                <ul class="navbar-nav mr-auto">\n' +
                    '\n' +
                    '\n' +
                    '\n' +
                    '                        <div class="dropdown">\n' +
                    '                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                    '                                Hi uu\n' +
                    '                            </a>\n' +
                    '\n' +
                    '                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">\n' +
                    '                                \n' +
                    '                                    <a class="dropdown-item" onclick="showProfile()">Profile</a>\n' +
                    '\n' +
                    '                                    <a class="dropdown-item" onclick="showTrending()">Trending Posts</a>\n' +
                    '\n' +
                    '\n' +

                    "                    <a class=\"dropdown-item\" href=\"#\" onclick='logout()' data-toggle=\"modal\" data-target=\"#logout\">\n" +
                    "                        Log Out\n" +
                    "                    </a>\n" +

                    '                            </div>\n' +
                    '                        </div>\n' +
                    '\n' +
                    '\n' +
                    '                </ul>\n' +
                    '            </div>\n' +
                    '        </div>';


                getUsername();
                //   document.getElementById("login").style.display="none";
                $('#login').modal('hide')

                isTeacher();
            }
            else{

                document.getElementById("errorInLoggingIn").innerHTML='Wrong user name or password';

            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    if (document.getElementById("iamdoc").checked) {
        xhttp.send("username=" + un.value + "&password=" + pass.value + "&state=login&usertype=teacher");

    }
    else {
        xhttp.send("username=" + un.value + "&password=" + pass.value + "&state=login&usertype=student");

    }

}


function filtersearch() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('tablebody').innerHTML = this.responseText;
        }
    }
    xhttp.open('GET', 'ajaxcodes.php?search=' + document.getElementById('search').value, true);
    xhttp.send();
}


function  showSuggestion() {


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {


        if (this.readyState == 4 && this.status == 200) {

         //   alert(this.responseText+"show sgt");

            document.getElementById("sgt").innerHTML=this.responseText;
        }
    }
    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=suggestion");

}


function  search() {


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            //if(this.responseText==1)
            {

                document.getElementById("recent_posts").innerHTML=this.responseText;



            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=search&query="+document.getElementById('sin').value);

}

function session() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            if (this.responseText == 1) {

                var ldiv = document.getElementById("options");

                // ldiv.innerHTML = "<li class=\"nav-item \">\n" +
                //     "\n" +
                //     "                    <a class=\"nav-link\" href=\"#\" onclick='logout()' data-toggle=\"modal\" data-target=\"#logout\">\n" +
                //     "                        Log Out\n" +
                //     "                    </a>\n" +
                //     "                </li>";


                ldiv.innerHTML ='<div class="form-inline my-2 my-lg-0">\n' +
                    '\n' +
                    '            <div class="collapse navbar-collapse">\n' +
                    '                <ul class="navbar-nav mr-auto">\n' +
                    '\n' +
                    '\n' +
                    '\n' +
                    '                        <div class="dropdown">\n' +
                    '                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                    '                                Hi uu\n' +
                    '                            </a>\n' +
                    '\n' +
                    '                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">\n' +
                    '                                \n' +
                    '                                    <a class="dropdown-item" onclick="showProfile()">Profile</a>\n' +
                    '\n' +
                    '                                    <a class="dropdown-item" onclick="showTrending()">Trending Posts</a>\n' +
                    '\n' +
                    '\n' +

                    "                    <a class=\"dropdown-item\" href=\"#\" onclick='logout()' data-toggle=\"modal\" data-target=\"#logout\">\n" +
                    "                        Log Out\n" +
                    "                    </a>\n" +

                    '                            </div>\n' +
                    '                        </div>\n' +
                    '\n' +
                    '\n' +
                    '                </ul>\n' +
                    '            </div>\n' +
                    '        </div>';


                getUsername();
                //   document.getElementById("login").style.display="none";
                $('#login').modal('hide')
            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=session");


}


function logout() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            //if(this.responseText==1)
            {

                window.location.replace("index.html");



            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=logout");


}


function showTrending(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            //if(this.responseText==1)
            {

                document.getElementById("recent_posts").innerHTML=this.responseText;



            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=trending");
}

function getRecentposts() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            //if(this.responseText==1)
            {

                document.getElementById("recent_posts").innerHTML=this.responseText;



            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=recentposts");


}

function postArticle() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

            //   alert(this.responseText);

            //if(this.responseText==1)
            {

               // alert(this.responseText);

                if(this.responseText==1){

                    document.getElementById("input_article").getElementsByTagName("input")[0].value="";
                    document.getElementById("input_article").getElementsByTagName("textarea")[0].value="";

                    getRecentposts();
                }
                else{

                    $('#login').modal('show');
                }



            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    // $name =$_POST['name'];
    // $about=$_POST['about'];
    // $type =$_POST['type'];
    // $tid = $_SESSION["userid"];

    var name = document.getElementById("input_article").getElementsByTagName("input")[0].value;
    var about= document.getElementById("input_article").getElementsByTagName("textarea")[0].value;
    var type = document.getElementById("input_article").getElementsByTagName("select")[0].value;


  //  alert(name+about+type);

    xhttp.send("state=postArticle&name="+name+"&about="+about+"&type="+type);


}


function addComment( p) {


    var comment = document.getElementById(p).getElementsByTagName("textarea")[0].value;

   // alert(p+comment);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

             //  alert(this.responseText);

            if(this.responseText==1)
            {

               // alert("added");

                     getRecentposts();

            }
            else{

                $('#login').modal('show');
            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=addComment&articleName="+p+"&comment="+comment);


}


function showProfile(){




    // var name = document.getElementById("pname").value;
    // var id = document.getElementById("pid").value;
    // var email = document.getElementById("pemail").value;
    // var ut = document.getElementById("pusertype").value;
    //
    // var phone = document.getElementById("pphone").value;
    // var pass = document.getElementById("ppassword").value;
    // var gen = document.getElementById("pgender").value;
    //
    // var iamt = document.getElementById("piamt").checked;
    //
    //
    // alert(name + id + email + ut + phone + pass + gen + iamt);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

           // alert(this.responseText);


            document.getElementById("profile").innerHTML = this.responseText;

            $('#profile').modal('show');

            }

        }


    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("state=show_profile");








}


function isTeacher() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('tablebody').innerHTML=this.responseText;

              // alert(this.responseText);

            if(this.responseText==1)
            {

                document.getElementById('td').style.display="block";



            }
            else{

                document.getElementById('td').style.display="none";
            }

        }
    }

    xhttp.open("POST", "SuperController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.send("state=checkFaculty");


}

session();

isTeacher();
