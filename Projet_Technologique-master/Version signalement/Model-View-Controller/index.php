<?php
include_once "controller/Controller.php";
include_once "controller/SigninController.php";
include_once "controller/NewParent.php";
include_once "controller/ParentController.php";
include_once "controller/KidController.php";
include_once "controller/AdminController.php";

include_once "view/View.php";
include_once "view/Accueil.php";
include_once "view/Bienvenu.php";
include_once "view/WelcomeParent.php";
include_once "view/NewMember.php";
include_once "view/FormNewMember.php";
include_once "view/Entete.php";
include_once "view/Navbar.php";
include_once "view/Changer.php";
include_once "view/Forum.php";
include_once "view/Sujet.php";
include_once "view/ListArticle.php";
include_once "view/Article.php";
include_once "view/MemberList.php";
include_once "view/SignalList.php";
include_once "view/ModerButton.php";
include_once "view/WarningList.php";
include_once "view/ParentProfil.php";
include_once "view/ListeConnexion.php";
include_once "view/ModList.php";
include_once "view/ListActiviteMod.php";
include_once "view/MessageContester.php";
include_once "view/AdminContestation.php";


include_once "model/Model.php";
include_once "model/Dbase.php";
include_once "model/Check.php";
include_once "model/CheckCode.php";
include_once "model/GetId.php";
include_once "model/MyKids.php";
include_once "model/AjoutParent.php";
include_once "model/GetForum.php";
include_once "model/GetPseudo.php";
include_once "model/GetSujet.php";
include_once "model/GetComment.php";
include_once "model/AjoutComment.php";
include_once "model/AjoutForum.php";
include_once "model/AjoutEnfant.php";
include_once "model/UpdatePseudo.php";
include_once "model/UpdateMdp.php";
include_once "model/GetArticle.php";
include_once "model/GetAllArticles.php";
include_once "model/IsSuspend.php";
include_once "model/UpdateComment.php";
include_once "model/GetAllMembers.php";
include_once "model/AlterSuspension.php";
include_once "model/GetSignalement.php";
include_once "model/Moderation.php";
include_once "model/GetWarning.php";
include_once "model/GetProfil.php";
include_once "model/GetEtalissement.php";
include_once "model/AddArticle.php";
include_once "model/GetPHoraire.php";
include_once "model/UpdateTimeConnexion.php";
include_once "model/Updateplagehoraire.php";
include_once "model/GetKidConnexion.php";
include_once "model/NewKidConnection.php";
include_once "model/ModerationMod.php";
include_once "model/ListCommentModerer.php";
include_once "model/GetAllComment.php";
include_once "model/UpdateMail.php";
include_once "model/UpdateMdpParent.php";
include_once "model/GetToContest.php";
include_once "model/ChoixContstation.php";
include_once "model/GetContestation.php";
include_once "model/Comments.php";
include_once "model/UpdateComments.php";
include_once "model/EssaiPython.php";
include_once "model/AddBdd.php";



session_start();

$controller=new Controller();
$controller->launch();
?>
