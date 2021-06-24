<?= $this->extend('Templates/example') ?>
<?= $this->section('modulo') ?>
<div class="row">
    <div class="col s12">
    <div class="container">
        <div id="login-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <?= $alert ?>
            <form class="login-form" method="<?=$method?>" action="<?=$action?>">
                <div class="row margin">
                    <div class="input-field">
                        <i class="material-icons prefix">person_outline</i>
                        <input id="_username" name="username" type="text">
                        <label for="_username" class="center-align">Correo</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="_password" name="password" type="password">
                        <label for="_password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn btn-large waves-effect waves-light blue darken-3 col s12">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
<?= $this->endSection() ?>  