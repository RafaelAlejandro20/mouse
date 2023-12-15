<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(200,200,200);
            margin: 0px;
            padding: 0px;
        }
        .contenedor-principal{
            width: 900px;
            height: 600px;
            background: rgb(20,20,20);
            border-radius: 10px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 20px 20px rgba(0,0,0,0.20);
        }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgb(40,40,40);
        }
        .imagen{
            width: 50%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .video{
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .contenido{
            width: 100%;
            height: 50%;
            display: flex;
            flex-direction: row;
        }
        .tamano{
            height: 300px;
            border-radius: 10px;
        }
        .img1{
            border-top-left-radius: 10px;
        }
        .img2{
            border-top-right-radius: 10px;
        }
    </style>
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>
    <h1>Mouse</h1>
    <article class="contenedor-principal">
        <section class="contenido">
            <section class="imagen">
                <canvas width="450px" height="300px" id="canvas1" class="img1"></canvas>
            </section>
            <section class="imagen">
                <canvas width="450px" height="300px" id="canvas2" class="img2"></canvas>
            </section>
        </section>
        <section class="contenido">
            <section class="video">
                <section id="lista3" class="tamano"></section>
            </section>
        </section>
    </article>
</body>
<!--<script src="index.js" type="module"></script>-->
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { getFirestore, doc, setDoc, collection, getDocs, addDoc, updateDoc, deleteDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBfiw-MY5ZfXxzBsx2vomazX4LfbAXqVpc",
        authDomain: "mosue-3f4e5.firebaseapp.com",
        projectId: "mosue-3f4e5",
        storageBucket: "mosue-3f4e5.appspot.com",
        messagingSenderId: "264425567241",
        appId: "1:264425567241:web:44d858d05e966d5459f4d8"
    };

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);

    setInterval(async (e) => {
        const querySnapshot1 = await getDocs(collection(db, "Seccion_uno"));
        querySnapshot1.forEach((doc) => {
        console.log(doc.id, doc.data().enlace);
        var valor1 = doc.data().enlace;
        var canvas1 = document.getElementById('canvas1');
        var ctx1 = canvas1.getContext("2d");
        var imagen1 = new Image();
        imagen1.src = ""+valor1+"";
        imagen1.onload = function () {
            ctx1.drawImage(imagen1,0,0,450,300);
        }
        });

        const querySnapshot2 = await getDocs(collection(db, "Seccion_dos"));
        querySnapshot2.forEach((doc) => {
        console.log(doc.id, doc.data().enlace);
        var valor2 = doc.data().enlace;
        var canvas2 = document.getElementById('canvas2');
        var ctx2 = canvas2.getContext("2d");
        var imagen2 = new Image();
        imagen2.src = ""+valor2+"";
        imagen2.onload = function () {
            ctx2.drawImage(imagen2,0,0,450,300);
        }
        });
        
        const lista3 = document.getElementById('lista3')
        const querySnapshot3 = await getDocs(collection(db, "Videos"));
        querySnapshot3.forEach((doc) => {
        console.log(doc.id, doc.data().enlace);
        lista3.innerHTML = `<div><video src="${doc.data().enlace}" autoplay loop muted height="300px"></video></div>`
        });
    },10000);
</script>
</html>