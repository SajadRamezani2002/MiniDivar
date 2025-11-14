<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ثبت‌نام | مینی‌دیوار</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>مینی‌دیوار</h1>
    <nav>
      <a href="index.html">خانه</a>
      <a href="login.html">ورود</a>
    </nav>
  </header>

  <main>
    <form class="box">
      <h2>ثبت‌نام</h2>
      <input type="text" placeholder="نام کاربری" required>
      <input type="email" placeholder="ایمیل" required>
      <input type="password" placeholder="رمز عبور" required>
      <button>ثبت‌نام</button>
    </form>
  </main>

  @include('footer')
</body>
</html>
