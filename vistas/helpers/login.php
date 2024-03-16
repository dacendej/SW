<?php

function buildFormularioLogin($username='', $password='')
{
    return <<<EOS
    <form id="formLogin" action="procesarLogin.php" method="POST">
        <fieldset>
            <legend>Usuario y contraseña</legend>
            <div><label>Usuario:</label> <input type="text" name="username" value="$username" /></div>
            <div><label>Contraseña:</label> <input type="password" name="password" password="$password" /></div>
            <div><button type="submit">Entrar</button></div>
        </fieldset>
    </form>
    EOS;
}