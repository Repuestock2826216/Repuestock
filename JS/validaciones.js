// function validarClienteNuevo()
// {
//     const regextexto = /^[A-Za-z\s]+$/;
//     const nombres= document.getElementById("nombre").value
//     if (!regextexto.test(nombres))
//     {
//         alert ("el campo solo recibe letras")
//         return false
//     }

// }

function validarCorreo()
{
    const regexemail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.(com|co|es)$/;
    const email= document.getElementById("email").value
    if (!regexemail.test(email))
    {
        alert ("el correo no tiene la nomenclatura correcta")
        return false
    }
}

function bloquearNumeros(event) 
{
	const teclaPresionada = event.key;
    if (teclaPresionada >= '0' && teclaPresionada <= '9') {
        event.preventDefault();
    }
}

