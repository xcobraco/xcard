<?php
session_start();
include '../inc/connection.php';

if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: ../admin.html");
    exit(); // Ensure that the script stops execution after the redirect
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username1 = $_SESSION['username'];

// Perform database query to retrieve user count
$businessCountSql = "SELECT COUNT(*) as businessCount FROM users";
$businessCountResult = $conn->query($businessCountSql);
$businessCount = ($businessCountResult->num_rows > 0) ? $businessCountResult->fetch_assoc()['businessCount'] : 0;

// Perform database query to retrieve pet count
$petCountSql = "SELECT COUNT(*) as petCount FROM pet";
$petCountResult = $conn->query($petCountSql);
$petCount = ($petCountResult->num_rows > 0) ? $petCountResult->fetch_assoc()['petCount'] : 0;

$staffCountSql = "SELECT COUNT(*) as staffCount FROM admin";
$staffCountResult = $conn->query($staffCountSql);
$staffCount = ($staffCountResult->num_rows > 0) ? $staffCountResult->fetch_assoc()['staffCount'] : 0;

$doneCountSql = "SELECT COUNT(*) as doneCount FROM purchase WHERE Status='Done'";
$doneCountResult = $conn->query($doneCountSql);
$doneCount = ($doneCountResult->num_rows > 0) ? $doneCountResult->fetch_assoc()['doneCount'] : 0;

$pendingCountSql = "SELECT COUNT(*) as pendingCount FROM purchase WHERE Status='Pending'";
$pendingCountResult = $conn->query($pendingCountSql);
$pendingCount = ($pendingCountResult->num_rows > 0) ? $pendingCountResult->fetch_assoc()['pendingCount'] : 0;

$totalusers = $businessCount + $petCount;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
   <title>Dashboard</title>
    <style>
    @white: #fff;
    @blue: #4b84fe;
    @colorDark: #1b253d;
    @colorLight: #99a0b0;
    @red: #fa5b67;
    @yellow: #ffbb09;
    @bg: #f5f5fa;
    @bgDark: #ede8f0;
    
    * {
        box-sizing: border-box;
    }
    
    html,
    body {
        color: @colorLight;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: @bg;
        font-size: 16px;
        line-height: 120%;
        font-family: Open Sans, Helvetica, sans-serif;
    }
    
    .dashboard {
        display: grid;
        width: 100%;
        height: 100%;
        grid-gap: 0;
        grid-template-columns: 300px auto;
        grid-template-rows: 80px auto;
      grid-template-areas: 'menu search'
                                                    'menu content';
    }
    
    .search-wrap {
        grid-area: search;
        background: @white;
        border-bottom: 1px solid @bgDark;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 3em;
        
        .search {
            height: 40px;
            
            label {
                display: flex;
                align-items: center;
                height: 100%;
                
                svg {
                    display: block;
                    
                    path,
                    circle {
                        fill: lighten(@colorLight, 10%);
                        transition: fill .15s ease;
                    }
                }
                
                input {
                    display: block;
                    padding-left: 1em;
                    height: 100%;
                    margin: 0;
                    border: 0;
                    
                    &:focus {
                        background: @bg;
                    }
                }
                
                &:hover {
                    svg {
                        path,
                        circle {
                            fill: lighten(@colorDark, 10%);
                        }
                    }
                }
            }
        }
        
        .user-actions {
            button {
                border: 0;
                background: none;
                width: 32px;
                height: 32px;
                margin: 0;
                padding: 0;
                margin-left: 0.5em;
                
                svg {
                    position: relative;
                    top: 2px;
                    
                    path,
                    circle {
                        fill: lighten(@colorLight, 10%);
                        transition: fill .15s ease;
                    }
                }
                
                &:hover {
                    svg {
                        path,
                        circle {
                            fill: lighten(@colorDark, 10%);
                        }
                    }
                }
            }
        }
    }
    
    .menu-wrap {
        grid-area: menu;
        padding-bottom: 3em;
        overflow: auto;
        background: @white;
        border-right: 1px solid @bgDark;
        
        .user {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin: 0;
            padding: 0 3em;
            
            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                overflow: hidden;
                
                img {
                    display: block;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            
            figcaption {
                margin: 0;
                padding: 0 0 0 1em;
                color: @colorDark;
                font-weight: 700;
                font-size: 0.875em;
                line-height: 100%;
            }
        }
        
        nav {
            display: block;
            padding: 0 3em;
            
            section {
                display: block;
                padding: 3em 0 0;
            }
            
            h3 {
                margin: 0;
                font-size: .875em;
                text-transform: uppercase;
                color: @blue;
                font-weight: 600;
            }
            
            ul {
                display: block;
                padding: 0;
                margin: 0;
            }
            
            li {
                display: block;
                padding: 0;
                margin: 1em 0 0;
                
                a {
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    color: @colorLight;
                    text-decoration: none;
                    font-weight: 600;
                    font-size: .875em;
                    transition: color .15s ease;
                    
                    svg {
                        display: block;
                        margin-right: 1em;
                        
                        path,
                        circle {
                            fill: lighten(@colorLight, 10%);
                            transition: fill .15s ease;
                        }
                    }
                    
                    &:hover {
                        color: @colorDark;
                        
                        svg {
                            path,
                            circle  {
                                fill: lighten(@colorDark, 10%);
                            }
                        }
                    }
                    
                    &.active {
                        color: @blue;
                        
                        svg {
                            path,
                            circle  {
                                fill: @blue;
                            }
                        }
                    }
                }
            }
        }
    }
    
    .content-wrap {
        grid-area: content;
        padding: 3em;
        overflow: auto;
        
        .content-head	{
            display: flex;
            align-items: center;
            justify-content: space-between;
            
            h1 {
                font-size: 1.375em;
                line-height: 100%;
                color: @colorDark;
                font-weight: 500;
                margin: 0;
                padding: 0;
            }
            
            .action {
                button {
                    border: 0;
                    background: @blue;
                    color: @white;
                    width: auto;
                    height: 3.5em;
                    padding: 0 2.25em;
                    border-radius: 3.5em;
                    font-size: 1em;
                    text-transform: uppercase;
                    font-weight: 600;
                    transition: background-color .15s ease;
                    
                    &:hover {
                        background-color: darken(@blue, 10%);
                        
                        &:active {
                            background-color: darken(@blue, 20%);
                            transition: none;
                        }
                    }
                }
            }
        }
    
        .info-boxes {
            padding: 3em 0 2em;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            grid-gap: 2em;
            
            .info-box {
                background: @white;
                height: 160px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                padding: 0 3em;
                border: 1px solid @bgDark;
                border-radius: 5px;
                
                .box-icon {
                    svg {
                        display: block;
                        width: 48px;
                        height: 48px;
                        
                        path,
                        circle {
                            fill: @colorLight;
                        }
                    }
                }
                
                .box-content {			
                    padding-left: 1.25em;
                    white-space: nowrap;
                    
                    .big {
                        display: block;
                        font-size: 2em;
                        line-height: 150%;
                        color: @colorDark;
                    }
                }
                
                &.active {
                    svg {
                        circle,
                        path {
                            fill: @blue;
                        }
                    }
                }
            }
        }
    
        .person-boxes {
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            grid-gap: 2em;
            
            .person-box {
                background: @white;
                height: 320px;
                text-align: center;
                padding: 3em;
                border: 1px solid @bgDark;
                border-radius: 5px;
                
                &:nth-child(2n) {
                    .box-avatar {
                        .no-name {
                            background: @blue;
                        }
                    }
                }
                
                &:nth-child(5n) {
                    .box-avatar {
                        .no-name {
                            background: @yellow;
                        }
                    }
                }
                
                .box-avatar {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    margin: 0px auto;
                    overflow: hidden;
                    
                    img {
                        display: block;
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                    
                    .no-name {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        text-align: center;
                        color: @white;
                        font-size: 1.5em;
                        font-weight: 600;
                        text-transform: uppercase;
                        width: 100%;
                        height: 100%;
                        background: @red;
                    }
                }
                
                .box-bio {
                    white-space: no-wrap;
                    
                    .bio-name {
                        margin: 2em 0 .75em;
                        color: @colorDark;
                        font-size: 1em;
                        font-weight: 700;
                        line-height: 100%;
                    }
                    
                    .bio-position {
                        margin: 0;
                        font-size: .875em;
                        line-height: 100%;
                    }
                }
                
                .box-actions {
                    margin-top: 1.25em;
                    padding-top: 1.25em;
                    width: 100%;
                    border-top: 1px solid @bgDark;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    
                    button {
                        border: 0;
                        background: none;
                        width: 32px;
                        height: 32px;
                        margin: 0;
                        padding: 0;
    
                        svg {
                            position: relative;
                            top: 2px;
    
                            path,
                            circle {
                                fill: lighten(@colorLight, 10%);
                                transition: fill .15s ease;
                            }
                        }
    
                        &:hover {
                            svg {
                                path,
                                circle {
                                    fill: lighten(@colorDark, 10%);
                                }
                            }
                        }
                    }
                }
            }
        }
    } 
    </style>
</head>

<body>
<div class="dashboard">
    <aside class="search-wrap">
        <div class="search"></div>        
        <div class="user-actions">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.094 2.085l-1.013-.082a1.082 1.082 0 0 0-.161 0l-1.063.087C6.948 2.652 4 6.053 4 10v3.838l-.948 2.846A1 1 0 0 0 4 18h4.5c0 1.93 1.57 3.5 3.5 3.5s3.5-1.57 3.5-3.5H20a1 1 0 0 0 .889-1.495L20 13.838V10c0-3.94-2.942-7.34-6.906-7.915zM12 19.5c-.841 0-1.5-.659-1.5-1.5h3c0 .841-.659 1.5-1.5 1.5zM5.388 16l.561-1.684A1.03 1.03 0 0 0 6 14v-4c0-2.959 2.211-5.509 5.08-5.923l.921-.074.868.068C15.794 4.497 18 7.046 18 10v4c0 .107.018.214.052.316l.56 1.684H5.388z"/></svg>
            </button>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 21c4.411 0 8-3.589 8-8 0-3.35-2.072-6.221-5-7.411v2.223A6 6 0 0 1 18 13c0 3.309-2.691 6-6 6s-6-2.691-6-6a5.999 5.999 0 0 1 3-5.188V5.589C6.072 6.779 4 9.65 4 13c0 4.411 3.589 8 8 8z"/><path d="M11 2h2v10h-2z"/></svg>
            </button>
        </div>
    </aside>
    
    <header class="menu-wrap">
        <figure class="user">
            <div class="user-avatar">
                <img src="../img/xcobralogo.png" alt="Xcobra">
            </div>
            <figcaption>
            <?php echo htmlspecialchars($username1); ?>
            </figcaption>
        </figure>
    
        <nav>
            <section class="dicover">
                <h3>Business Cards</h3>
                
                <ul>
                    <li>
                        <a href="customerRegister.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.855 14.365l-1.817 6.36a1.001 1.001 0 0 0 1.517 1.106L12 18.202l5.445 3.63a1 1 0 0 0 1.517-1.106l-1.817-6.36 4.48-3.584a1.001 1.001 0 0 0-.461-1.767l-5.497-.916-2.772-5.545c-.34-.678-1.449-.678-1.789 0L8.333 8.098l-5.497.916a1 1 0 0 0-.461 1.767l4.48 3.584zm2.309-4.379c.315-.053.587-.253.73-.539L12 5.236l2.105 4.211c.144.286.415.486.73.539l3.79.632-3.251 2.601a1.003 1.003 0 0 0-.337 1.056l1.253 4.385-3.736-2.491a1 1 0 0 0-1.109-.001l-3.736 2.491 1.253-4.385a1.002 1.002 0 0 0-.337-1.056l-3.251-2.601 3.79-.631z"/></svg>
                            Create New User
                        </a>
                    </li>
                    
                    <li>
                        <a href="insert.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13 7L11 7 11 11 7 11 7 13 11 13 11 17 13 17 13 13 17 13 17 11 13 11z"/><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z"/></svg>
                            Add New User
                        </a>
                    </li>
                    
                    <li>
                        <a href="table.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"/></svg>
                            View Users
                        </a>
                    </li>
                </ul>
            </section>

            <section class="tools">
                <h3>Pet Tags</h3>
                
                <ul>
                    <li>
                        <a href="petRegister.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.855 14.365l-1.817 6.36a1.001 1.001 0 0 0 1.517 1.106L12 18.202l5.445 3.63a1 1 0 0 0 1.517-1.106l-1.817-6.36 4.48-3.584a1.001 1.001 0 0 0-.461-1.767l-5.497-.916-2.772-5.545c-.34-.678-1.449-.678-1.789 0L8.333 8.098l-5.497.916a1 1 0 0 0-.461 1.767l4.48 3.584zm2.309-4.379c.315-.053.587-.253.73-.539L12 5.236l2.105 4.211c.144.286.415.486.73.539l3.79.632-3.251 2.601a1.003 1.003 0 0 0-.337 1.056l1.253 4.385-3.736-2.491a1 1 0 0 0-1.109-.001l-3.736 2.491 1.253-4.385a1.002 1.002 0 0 0-.337-1.056l-3.251-2.601 3.79-.631z"/></svg>
                            Create New Pet
                        </a>
                    </li>

                    <li>
                        <a href="petInsert.php" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13 7L11 7 11 11 7 11 7 13 11 13 11 17 13 17 13 13 17 13 17 11 13 11z"/><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z"/></svg>
                            Add new Pet
                        </a>
                    </li>
                    
                    <li>
                        <a href="petTable.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"/></svg>
                            View All Pets
                        </a>
                    </li>
                </ul>
            </section>
        
            <section class="tools">
                <h3>More Options</h3>
                
                <ul>
                    <li>
                        <a href="cusReqs.php" class="active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 2.293A.996.996 0 0 0 12 2H3a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l9 9a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-9-9zM12 19.586l-8-8V4h7.586l8 8L12 19.586z"/><circle cx="7.507" cy="7.505" r="1.505"/></svg> 
                            Customer Requests
                        </a>
                    </li>
                    <li>
                        <a href="orders.php" class="active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 2.293A.996.996 0 0 0 12 2H3a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l9 9a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-9-9zM12 19.586l-8-8V4h7.586l8 8L12 19.586z"/><circle cx="7.507" cy="7.505" r="1.505"/></svg> 
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="../inc/multiLogin.php" class="active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 2.293A.996.996 0 0 0 12 2H3a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l9 9a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-9-9zM12 19.586l-8-8V4h7.586l8 8L12 19.586z"/><circle cx="7.507" cy="7.505" r="1.505"/></svg> 
                            Customer Login
                        </a>
                    </li>
                    
                    <li>
                        <a href="test.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 2.293A.996.996 0 0 0 12 2H3a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l9 9a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-9-9zM12 19.586l-8-8V4h7.586l8 8L12 19.586z"/><circle cx="7.507" cy="7.505" r="1.505"/></svg>
                            Test
                        </a>
                    </li>
                </ul>
            </section>
            
            
        </nav>
    </header>
    
    <main class="content-wrap">
        <header class="content-head">
            <h1>Admin Dashboard</h1>
                
            <div class="action">
                <button>
                    Version 0.1.8v
                </button>
            </div>
        </header>
        
        <div class="content">
            <section class="info-boxes">
                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 20V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1zm-2-1H5V5h14v14z"/><path d="M10.381 12.309l3.172 1.586a1 1 0 0 0 1.305-.38l3-5-1.715-1.029-2.523 4.206-3.172-1.586a1.002 1.002 0 0 0-1.305.38l-3 5 1.715 1.029 2.523-4.206z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $totalusers; ?></span>
                        User Count
                    </div>
                </div>
                
                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 10H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1zm-1 10H5v-8h14v8zM5 6h14v2H5zM7 2h10v2H7z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $businessCount; ?></span>
                        Total Business Cards
                    </div>
                </div>
                
                <div class="info-box active">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3,21c0,0.553,0.448,1,1,1h16c0.553,0,1-0.447,1-1v-1c0-3.714-2.261-6.907-5.478-8.281C16.729,10.709,17.5,9.193,17.5,7.5 C17.5,4.468,15.032,2,12,2C8.967,2,6.5,4.468,6.5,7.5c0,1.693,0.771,3.209,1.978,4.219C5.261,13.093,3,16.287,3,20V21z M8.5,7.5 C8.5,5.57,10.07,4,12,4s3.5,1.57,3.5,3.5S13.93,11,12,11S8.5,9.43,8.5,7.5z M12,13c3.859,0,7,3.141,7,7H5C5,16.141,8.14,13,12,13z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $staffCount; ?></span>
                        Total Staff
                    </div>
                </div>
                
                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $petCount; ?></span>
                        Total Pet Tags
                    </div>
                </div>

                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $pendingCount; ?></span>
                        Pending Orders
                    </div>
                </div>

                <div class="info-box">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z"/></svg>
                    </div>
                    
                    <div class="box-content">
                        <span class="big"><?php echo $doneCount; ?></span>
                        Total Orders Done
                    </div>
                </div>
            </section>
            </section>
        </div>
    </main>
</div>
</body>

</html>

<?php
// Close connection
$conn->close();
?>