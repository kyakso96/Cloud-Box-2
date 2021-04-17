<?php
session_start();

if (!isset($_SESSION['loggedin'])) //Can't access page unless the user is logged in
{
    header("Location: index.php");
    die();

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>
</head>
<body>
<div class= "navbar">
    <div class="logo">
        CLOUD-BOX
    </div>
    <div class="nav-right">

        <a href="upload2.php">Upload Files</a>

        <a href="view-files.php">View Files</a>

        <a href="logout.php">Log Out</a>

    </div>
</div>
<br><br><br>
<div class="container" style="background: white; opacity: 0.7;" >
    <div class="content">
        <div style="display: table-row">
            <div style="width: 600px; display: table-cell;" class="arbor-grid-element pisces-rebrand-inline arbor-centre--flex-start arbor-grid-element--width--1-1 arbor-grid-element--width--5-24--medium arbor-direction--column arbor-spacing--flex-start"><div class="pisces-rebrand-block__image-container"><img srcset="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/syncing-vfl5qmpJE.svg" alt="Store and sync your files with Cloud-Box" src="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/syncing-vfl5qmpJE.svg"></div><h2 class="arbor-headline arbor-headline--22 arbor-headline--title-2 arbor-foreground-color--panda-black pisces-rebrand-block__headline">Store and sync</h2><p class="arbor-copy arbor-copy--standard arbor-foreground-color--panda-black pisces-rebrand-block__description">Keep all your files securely stored, up to date, and accessible from any device.</p></div>
            <div style="width: 600px;display: table-cell;" class="arbor-grid-element pisces-rebrand-inline arbor-align--flex-start arbor-grid-element--width--1-1 arbor-grid-element--width--5-24--medium arbor-direction--column arbor-spacing--flex-start"><div class="pisces-rebrand-block__image-container"><img srcset="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/share-vfllC7nq_.svg" alt="Share any file with Cloud-Box" src="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/share-vfllC7nq_.svg"></div><h2 class="arbor-headline arbor-headline--22 arbor-headline--title-2 arbor-foreground-color--panda-black pisces-rebrand-block__headline">Share</h2><p class="arbor-copy arbor-copy--standard arbor-foreground-color--panda-black pisces-rebrand-block__description">Quickly send any file — big or small — to anyone, even if they don’t have a Cloud-Box account.</p></div>
            <div style="width: 600px;display: table-cell;"  class="arbor-grid-element pisces-rebrand-block arbor-align--flex-start arbor-grid-element--width--1-1 arbor-grid-element--width--5-24--medium arbor-direction--column arbor-spacing--flex-start"><div class="pisces-rebrand-block__image-container"><img srcset="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/shield-vflEXMD4H.svg" alt="Stay secure with Cloud-Box" src="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/shield-vflEXMD4H.svg"></div><h2 class="arbor-headline arbor-headline--22 arbor-headline--title-2 arbor-foreground-color--panda-black pisces-rebrand-block__headline">Stay secure</h2><p class="arbor-copy arbor-copy--standard arbor-foreground-color--panda-black pisces-rebrand-block__description">Keep your files private with multiple layers of protection from the service trusted by millions.</p></div>
        </div><br>
        <div class="arbor-grid-element pisces-rebrand-block arbor-align--flex-start arbor-grid-element--width--1-1 arbor-grid-element--width--5-24--medium arbor-direction--column arbor-spacing--flex-start"><div class="pisces-rebrand-block__image-container"><img srcset="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/comment-vflqWafTI.svg" alt="Collaborate with Cloud-Box" src="https://cfl.dropboxstatic.com/static/images/index/pisces/quad/comment-vflqWafTI.svg"></div><h2 class="arbor-headline arbor-headline--22 arbor-headline--title-2 arbor-foreground-color--panda-black pisces-rebrand-block__headline">Collaborate</h2><p class="arbor-copy arbor-copy--standard arbor-foreground-color--panda-black pisces-rebrand-block__description">Manage tasks, track file updates and stay in sync with your teams and clients.</p></div>
        <br><br><br><br><br><br>
        <p>Cloud-Box is aimed for people that use cloud services to store their data files online on a cloud storage service (Businesses, students, public). This allows users to be able to access their documents instantly regardless of their location or the type of device available (Desktop, tablet, mobile phone), providing there is a network connection available. Cloud-Box enables the recovery and retrieval of the files in case of system breakdown, loss of data or the opportunity to access the previous versions of the edited documents which will be saved as backup and deleted periodically if not accessed for a specific time.</p>
    </div>
</div>
<footer>
    <p>All Right Reserved By Cloud-Box</p>
</footer>
</body>
</html>
