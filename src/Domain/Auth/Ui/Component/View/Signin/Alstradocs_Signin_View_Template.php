<?php

namespace Alstradocs\Domain\Assignment\Ui\Component\View\Signin;

use Alstradocs\Domain\Application\Alstradocs_Writing_Constants;
use Enterprise\Framework\Ui\Template\Alstradocs_Data_Template;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
class Alstradocs_Signin_View_Template
{

      use Alstradocs_Data_Template;

      /**
       *
       * @param template_data The template data
       */
      protected function do_render($template_data)
      {
        ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
            <!-- Favicon-->
            <link rel="icon" href="../../favicon.ico" type="image/x-icon">

            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        </head>

        <body class="login-page">
            <div class="login-box">
                <div class="logo">
                    <a href="javascript:void(0);">Admin<b>BSB</b></a>
                    <small>Admin BootStrap Based - Material Design</small>
                </div>
                <div class="card">
                    <div class="body">
                        <form id="sign_in" method="POST">
                            <div class="msg">Sign in to start your session</div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 p-t-5">
                                    <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                    <label for="rememberme">Remember Me</label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                                </div>
                            </div>
                            <div class="row m-t-15 m-b--20">
                                <div class="col-xs-6">
                                    <a href="sign-up.html">Register Now!</a>
                                </div>
                                <div class="col-xs-6 align-right">
                                    <a href="forgot-password.html">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>

        </html>

      <?php
    }
}
