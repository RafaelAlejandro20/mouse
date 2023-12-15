<?php
$base = $_POST['base'];
$id = $_POST['id'];
$dir_subida = 'img/';
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
?>
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { getFirestore, doc, setDoc, collection, getDocs } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

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

    await setDoc(doc(db, "<?php echo $base ?>", "<?php echo $id ?>"), {
        enlace: "<?php echo $fichero_subido; ?>"
    });
</script>
<?php
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <style>
            *{
                font-family: Arial, Helvetica, sans-serif;
                color: rgb(100,100,100);
                margin: 0px;
                padding: 0px;
            }
            .contenedor-principal{
                width: 300px;
                height: 150px;
                background: rgb(255,255,255);
                border-radius: 10px;
                margin-top: 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                box-shadow: 0px 20px 20px rgba(0,0,0,0.20);
            }
            body{
                display: flex;
                flex-direction: column;
                align-items: center;
                background: rgb(40,40,40);
            }
            input{
                margin: 10px;
            }
            .boton{
                width: 280px;
                height: 40px;
                border-radius: 20px;
                background: rgb(19, 118, 255);
                color: rgb(255,255,255);
                border: hidden;
            }
            .archivo{
                border: hidden;
                color: rgba(0,0,0,0);
            }
            label{
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <section class='contenedor-principal'>
            <h1>Mouse</h1>
            <label>Tu archivo se cargo con exito y se mostrará en menos de 20 segundos.</label>
            <form action='insertar.html' method='POST'>
                <input type='submit' value='Aceptar' class='boton'/>
            </form>
        </section>
    </body>
    </html>
    ";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
    header('Location: error.html');
}
?>