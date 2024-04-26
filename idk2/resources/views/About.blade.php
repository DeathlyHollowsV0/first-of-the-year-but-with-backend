{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Session Example</title>
</head>
<body>
    <?php if (Session::has('id')): ?>
        <p>Welcome, Si Oussema! </p>
    <?php else: ?>
        <center><h1>Khraj B7alk</h1></center>
    <?php endif; ?>
    <a href="/logout">Logout</a>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../static/style1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .about{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 2rem;
            background: var(--second-bg-color);
            padding-bottom: 6rem;
        }
        .heading{
            font-size: 5rem;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        span{
            color: var(--main-color);
        }
        
        .about-img{
            position: relative;
            width: 25rem;
            height: 25rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .about-img img{
            width: 90%;
            border-radius: 50%;
            border: .2rem solid var(--main-color);
        } 
        .about-img a{
            width: 90%;
            border-radius: 50%;
            border: .2rem solid var(--main-color);
        }
     
        .about-img .circle-spin{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border-top: .2rem solid var(--second-bg-color);
            border-bottom: .2rem solid var(--second-bg-color);
            border-left: .2rem solid var(--main-color);
            border-right: .2rem solid var(--main-color);
        }

        .about-content{
            text-align: center;
        }
        .about-content h3{
            font-size: 2.6rem;
        }
        .about-content p {
            font-size: 1.6rem;
            margin: 2rem 0 3rem;
        }
        .btn-box.btns{
            display: inline-block;
            width: 15rem;
        }
        .btn-box.btns a::before{
            background: var(--second-bg-color);
        }
        
        .education{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: auto;
            padding-bottom: 5rem;
        }
        .education .education-row{
            display: flex;
            flex-wrap: wrap;
            gap: 5rem;
        }
        .education-row .education-column{
            flex: 1 1 40rem;
        }
        .education-column .title{
            font-size: 2.5rem;
            margin:  0 0 1.5rem 2rem;
        }
        .education-column .education-box{
            border-left: .2rem solid var(--main-color);
        }
        .education-box .education-content{
            position: relative;
            padding-left: 2rem;
        }
        .education-box .education-content::before{
            content: '';
            position: absolute;
            top: 0;
            left: -1.1rem;
            width: 2rem;
            height: 2rem;
            background: var(--main-color);
            border-radius: 50%;
        }
        .education-content .content{
            position: relative;
            padding: 1.5rem;
            border: .2rem solid var(--main-color);
            border-radius: .6rem;
            margin-bottom: 2rem;
            overflow: hidden;
        }
        .education-content .content::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--second-bg-color);
            z-index: -1;
            transition: .5s;
        }
        .education-content .content:hover::before{
            width: 100%;
        }

        .education-content .content .year{
            font-size: 1.5rem;
            color: var(--main-color);
            padding-bottom: .5rem;
        }
        .education-content .content .year i{
            padding-right: .5rem;
        }
        .education-content .content h3{
            font-size: 2rem;
        }
        .education-content .content p{
            font-size: 1.6rem;
            padding-top: .5rem;
        }
        .container .header a{
            text-align: right;
            padding: 30px;
            border-bottom: 2px;
        }
        form {
            text-align: center;
            margin: 20px 0;
        }
        
        input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .get_weather {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .forecast-container {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .forecast-list {
            list-style: none;
            padding: 0;
            display: flex; 
            justify-content: space-around; 
            position: relative;
            position: relative; 
            z-index: 10;
            margin-bottom: 50px;
            height: calc(100vh - 5%);
            overflow-y: auto;
        }
        .forecast-item {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 10px;
            background-color: var(--second-bg-color); 
            text-align: center;
            max-width: 200px; 
        }
        .city-container{
            justify-content: center;
        }
        .home {
            display: flex;
            align-items: center;
            padding: 0 9% ;
            background-size: cover;
            background-position: center; 
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

*{  
    margin: 0;
    padding: 0 ;
    box-sizing: border-box;
    text-decoration: none;
    border: none;
    outline: none;
    scroll-behavior: smooth;
    font-family: 'Poppins', sans-serif;
}
:root{
    --bg-color: #081b29;
    --second-bg-color: #112e42;
    --text-color: #ededed;
    --main-color: #00abf0;
}

html{
    font-size: 62.5%;
    overflow-x: hidden;
}

body{
    background: var(--bg-color);
    color: var(--text-color);
}

.header{
    position: fixed;
    top:0;
    left: 0;
    width: 100%;
    padding: 2rem 9%;
    background: transparent;
    display: flex;
    justify-content: space-between;
    z-index: 100;
}

.logo{
    font-size: 2.5rem;
    color: var(--text-color);
    font-weight: 600;
}

.navbar a{
    font-size: 1.7rem;
    color: var(--text-color);
    font-weight: 500;
    margin-left: 3.5rem;
    transition: .3s;
}

.navbar a:hover,
.navbar a.active{
    color: var(--main-color);
}

#menu-icon{
    font-size: 3.6rem;
    color: var(--text-color);
    cursor: pointer;
    display: none;
}

section{
    min-height: 100vh;
    padding: 10rem 9% 2rem;
}


.home-content{
    max-width: 60rem;
    padding-left: 27px;
}
.home-content h1{
    font-size: 5.6rem;
    font-weight: 700;
    line-height: 1.3;
}

.home-content .text-animate{
    position: relative;
    width: 32.8rem;
}

.home-content .text-animate h3{
    font-size: 3.2rem;
    font-weight: 700;
    color: transparent;
    -webkit-text-stroke: .7px var(--main-color);
}
.home-content p{
    font-size: 1.6rem;
    margin: 2rem 0 4rem;
}

.btn-box{
    position: relative;
    display: flex;
    justify-content: space-between;
    width: 34.5rem;
    height: 5rem;
}

.btn-box .btn{
    position: relative;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 15rem;
    height: 100%;
    background: var(--main-color);
    border: .2rem solid var(--main-color);
    border-radius: .8rem;
    font-size: 1.8rem;
    font-weight: 600;
    letter-spacing: .1rem;
    color: var(--bg-color);
    z-index: 1;
    overflow: hidden;
    transition: .5s;
}

.btn-box .btn:hover{
    color: var(--main-color);
}

.btn-box .btn:nth-child(2){
    background: transparent;
    color: var(--main-color);
}

.btn-box .btn:nth-child(2):hover{
    color: var(--bg-color);
}

.btn-box .btn:nth-child(2)::before{
    background: var(--main-color);
}


.btn-box .btn::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: var(--bg-color);
    z-index: -1;
    transition: .5s;
}

.btn-box .btn:hover::before{
    width: 100%;
}

.home-sci{
    position: absolute;
    bottom: 4rem;
    width: 170px;
    display: flex;
    justify-content: space-between;
}

.home-sci a{
    position: relative;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    background: transparent;
    border: .2rem solid var(--main-color);
    border-radius: 50%;
    font-size: 20px;
    color: var(--main-color);
    z-index:1;
    overflow: hidden;
}

.home-sci a::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: var(--main-color);
    z-index:-1;
    transition: .5s;
}

.home-sci a:hover::before{
    width: 100%;
} 


.about{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 2rem;
    background: var(--second-bg-color);
    padding-bottom: 6rem;
}

.heading{
    font-size: 5rem;
    margin-bottom: 3rem;
    text-align: center;
}


.about-img{
    position: relative;
    width: 25rem;
    height: 25rem;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.about-img img{
    width: 90%;
    border-radius: 50%;
    border: .2rem solid var(--main-color);
}
.comparison-container .city-container {
    
    text-align: center;
}

.image-with-text {
    display: flex; 
    align-items: center; 
    justify-content: center; 
    padding: 20px; 
}

.full-width-image img {
    width: 40vw;
    height: 40vw; 
    object-fit: cover; 
    display: block; 
}

.funny-phrase p {
    font-size: 2rem; 
    color: var(--main-color); 
    margin-left: 20px; 
    font-weight: bold; 
    max-width: 60vw; 
}

body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}


.navbar {
    background-color: #333;
    color: white;
    display: flex;
    justify-content: space-between; 
    align-items: center; 
    padding: 0 2rem; 
    box-shadow: 0 2px 4px rgba(0,0,0,0.2); 
}


.navbar .navbar-brand img {
    height: 60px;
    width: auto; 
}

.navbar-nav {
    list-style: none; 
    display: flex; 
    margin: 0;
    padding: 0;
}


.navbar-nav .nav-item {
    padding: 1rem;
}


.navbar-nav .nav-link {
    color: white;
    text-decoration: none; 
}





    </style>
</head>
<body>
    <?php if (Session::has('id')): ?>

    <nav id="cc" class="navbar navbar-expand-lg navbar-light bg-white sticky-top ">
        <div class="container " style="display: flex">
            <p class="navbar-brand">
                <img src="/images/ofppt_logo-removebg-preview.png" alt="logo" class="navbar-logo">
            </p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedAbsence" aria-controls="navbarSupportedAbsence" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedAbsence">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"><li class="nav-item">
                        <a class="nav-link" href="/welcome">Page d'accueil <i class="bi bi-house-door-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ajouter-absence') }}">Ajouter Absence <i class="bi bi-plus-circle-fill"></i></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('absences.show') }}">Consulter les Absences <i class="bi bi-eye-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">Importer CSV <i class="bi bi-upload"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Imprimer">Impression <i class="bi bi-printer-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/graph">Graphiques <i class="bi bi-graph-up"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" style="color: red">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- home section design-->
    <section class="home" id="home">
        <div class="image-with-text">
            <div class="full-width-image">
                <img src="images/teams.png" alt="Team Image">
            </div>
            <div class="funny-phrase">
                <p>Best ideas from Anass and Oussama!</p>
                <p>Here are some of the best and most innovative ideas from Anass and Oussama, aiming to revolutionize our approach to technology and development.</p>

            </div>
        </div>
        

        </div>


        <div class="home-imgHover"></div>
    </section>
    <section class="home" id="home">
        <div class="about-img">
            <img src="images/anass.png" alt="">
            
        </div>
        <div class="home-content">
            <h1>Hi, I'm <span>anass afara</span></h1>
            <div class="text-animate">
                <h3>Backend Developer</h3>
            </div>
            <p>I possess a specialized technician diploma in Fullstack Development. Within our team, I am responsible for handling both front-end and back-end development tasks. My expertise lies in creating seamless user experiences and ensuring the functionality of our application across all aspects of development.</p>
            <div class="btn-box">
                <a href="#" class="btn">Hire Me</a>
                <a href="#" class="btn">Let's Talk</a>
            </div>
        </div>

        <div class="home-sci">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
    

        <div class="home-imgHover"></div>
        
    </section>
    <!-- home section design-->
    <section class="home" id="home">
        <div class="about-img">
            <img src="images/cos2.png" alt="">
            
        </div>
        <div class="home-content">
            <h1>Hi, I'm <span>Ousssama Khadira</span></h1>
            <div class="text-animate">
                <h3>Backend Developer</h3>
            </div>
            <p>I possess a specialized technician diploma in Fullstack Development. Within our team, I am responsible for handling both front-end and back-end development tasks. My expertise lies in creating seamless user experiences and ensuring the functionality of our application across all aspects of development.</p>
            <div class="btn-box">
                <a href="#" class="btn">Hire Me</a>
                <a href="#" class="btn">Let's Talk</a>
            </div>
        </div>

        <div class="home-sci">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
    

        <div class="home-imgHover"></div>
        
    </section>
    <section class="about" id="about">
        <h2 class="heading">About<span>anass</span></h2>
        <div class="about-img" style="height: 300px" >
            <img src="images/anass.png" alt="">
        </div>
        <div class="about-content">
            <h3>fullstack Developer!</h3>
            <p> Hi I am AFARA Anass ,I possess a specialized technician diploma in Fullstack Development. Within our team, I am responsible for handling both front-end and back-end development tasks. My expertise lies in creating seamless user experiences and ensuring the functionality of our application across all aspects of development.</p>
            <div class="btn-box btns">
                <a href="" class="btn">Download CV</a>
            </div>
        </div>
    </section>
    <section class="about" id="about">
        <h2 class="heading">About<span>Oussama</span></h2>
        <div class="about-img" style="height: 400px">
            <img src="images/cos1.png" alt="">
        </div>
        <div class="about-content">
            <h3>Injinyor !</h3>
            <p> Hi I am Khadira Oussama ,I possess a specialized technician diploma in Fullstack Development. Within our team, I am responsible for handling both front-end and back-end development tasks. My expertise lies in creating seamless user experiences and ensuring the functionality of our application across all aspects of development.</p>
            <div class="btn-box btns">
                <a href="" class="btn">Download CV</a>
            </div>
        </div>
    </section>
    <?php else: ?>
    <center><h1>page expired</h1></center>
<?php endif; ?>
</body>
</html> 