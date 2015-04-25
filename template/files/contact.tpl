
<div class="blog-post" id="cont">

    <!-- START BLOCK : ERRORS -->
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {ERROR}
    </div>
    <!-- END BLOCK : ERRORS -->

    <!-- START BLOCK : MELDING -->
    <div class="alert alert-info" role="alert">
        <p>{MELDING}</p>
    </div>
    <meta http-equiv="refresh" content="2; url=index.php?pageid="/>
    <!-- END BLOCK : MELDING -->

    <!-- START BLOCK : INFO -->
    <h3>Contact informatie</h3>
    <table class="table" id="contactinf">
        <tbody>
        <tr>
            <th>Naam</th>
            <td>Adriaan Giel</td>
        </tr>
        <tr>
            <th>Adres</th>
            <td>westerbeekstraat 82B</td>
        </tr>
        <tr>
            <th>Telefoonnummer</th>
            <td>0655575432</td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td>a3aan_G@live.nl</td>
        </tr>
        <tr>
            <th>Geboren</th>
            <td>15 oktober 1991</td>
        </tr>
        </tbody>
    </table>

    <p>Als je een bericht wil achterlaten kunt u <a href="index.php?pageid=14&action=1">hier</a> klikken voor het contactformulier.</p>
    <!-- END BLOCK : INFO -->

    <!-- START BLOCK : CONTACT -->
    <h2 class="blog-post-title ">Contactformulier</h2>
    <form class="form-horizontal" method="post" action="index.php?pageid=14&action=2">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="voornaam">Voornaam</label>
            <div class="col-sm-10">
                <input type="text" class="form-control input" id="voornaam" placeholder="voornaam" name="voornaam" value="{VOORNAAM}" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="achternaam">Achternaam</label>
            <div class="col-sm-10">
                <input type="text" class="form-control input" id="achternaam" placeholder="achternaam" name="achternaam" value="{ACHTERNAAM}" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Email">Email address</label>
            <div class="col-sm-10">
            <input type="email" class="form-control input" id="Email" placeholder="Enter email" name="email" value="{EMAIL}" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="onderwerp">Onderwerp</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="onderwerp" placeholder="Onderwerp" name="onderwerp" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="content">Bericht</label>
            <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="content" name="bericht"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
    <!-- END BLOCK : CONTACT -->
</div><!-- /.blog-post -->
