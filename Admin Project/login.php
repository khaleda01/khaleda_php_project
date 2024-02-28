<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Store Management Project</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css" />
    <style>
      body {
        background-color: #222F3E;
      }

      .login-form {
        max-width: 360px;
        margin: 0 auto;
        padding: 15px;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-top: 100px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
      }

      .login-form h2 {
        text-align: center;
        margin-bottom: 30px;
      }

      .form-control:focus {
        box-shadow: none;
      }

      .form-control {
        border-radius: 5px;
      }

      .btn-primary {
        background-color: #F39C12;
        border-color: #F39C12;
      }

      .btn-primary:hover {
        background-color: #e78e0a;
        border-color: #e78e0a;
      }

      .text-center {
        text-align: center;
      }

      .project-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
      }

      .team-name {
        text-align: center;
        font-size: 18px;
        color: #999999;
        margin-bottom: 30px;
      }

      .form-label {
        font-weight: bold;
      }

      .input-group-text {
        background-color: #ffffff;
        border-radius: 5px;
      }
    </style>
  </head>
  <body>
    <div class="login-form">
      <h2>Login</h2>
      <div class="project-title">Store Management Project</div>
      <div class="team-name">Team Code Scientist</div>
      <form action="includes/authentication.php" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">UserName</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-envelope"></i>
            </span>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter email" required />
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
      </form>
    </div>
  </body>
</html>
