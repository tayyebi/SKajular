<?php

function table( $result ) {
    $result->fetch_array( MYSQLI_ASSOC );
    echo '<table>';
    tableHead( $result );
    tableBody( $result );
    echo '</table>';
}

function tableHead( $result ) {
    echo '<thead>';
    foreach ( $result as $x ) {
    echo '<tr>';
    foreach ( $x as $k => $y ) {
        echo '<th>' . ucfirst( $k ) . '</th>';
    }
    echo '<th></th>';
    echo '</tr>';
    break;
    }
    echo '</thead>';
}

function tableBody( $result ) {
    echo '<tbody>';
    foreach ( $result as $x ) {
    echo '<tr>';
    foreach ( $x as $y ) {
        echo '<td>' . $y . '</td>';
    }
    echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?edit=' . $x['Id'] . '">ویرایش</a>';
    echo '<a href="' . $_SERVER['PHP_SELF'] . '?delete=' . $x['Id'] . '">حذف</a></td>';
    echo '</tr>';
    }
    echo '</tbody>';
}