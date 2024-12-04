<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = 'vinayakhotel';

$con = mysqli_connect($servername, $username, $password, $db);

if (!$con) {
    die("connect connect toh data base..." . mysqli_connect_error());
}

function filtration($data)
{
    foreach ($data as $key => $value) {
        $values = trim($value);
        $values = stripslashes($value);
        $values = strip_tags($value);
        $values = htmlspecialchars($value);

        $data[$key] = $values;
    }
    return $data;
}

function select($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("error in execution");
        }
    } else {
        die("error in preparation");
    }
}

function update($sq, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sq)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("error in execution - Update");
        }
    } else {
        die("error in preparation - Update");
    }
}

function insert($sq, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sq)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("error in execution - insert");
        }
    } else {
        die("error in preparation - insert");
    }
}

function delete($sq, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sq)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("error in execution - Delete");
        }
    } else {
        die("error in preparation - Delete");
    }
}

function selectAll($table)
{
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT*FROM $table");
    return $res;
}


?>