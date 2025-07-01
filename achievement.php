<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sunface Technologies – Achievements</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fff;
      color: #222;
    }

    .hero {
      background: linear-gradient(90deg, #e10000 0%, #ff512f 100%);
      color: #fff;
      padding: 48px 0 32px 0;
      text-align: center;
      box-shadow: 0 4px 24px rgba(225,0,0,0.10);
    }

    .hero h1 {
      font-size: 2.3rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin: 0;
      text-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .container {
      display: flex;
      flex-direction: column;
      position: relative;
      max-width: 700px;
      margin: 48px auto 48px auto;
      padding: 0 18px;
    }

    .timeline {
      position: absolute;
      left: 38px;
      top: 0;
      bottom: 0;
      width: 4px;
      background: linear-gradient(180deg, #e10000 0%, #ff512f 100%);
      border-radius: 2px;
      z-index: 0;
    }

    .achievement {
      position: relative;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(225,0,0,0.07);
      margin: 36px 0 36px 0;
      padding: 28px 32px 28px 90px;
      transition: box-shadow 0.18s, transform 0.18s;
      cursor: pointer;
      overflow: visible;
      z-index: 1;
      width: 100%;
      box-sizing: border-box;
    }

    .achievement:hover,
    .achievement:focus-within {
      box-shadow: 0 8px 36px rgba(225,0,0,0.18);
      transform: translateY(-4px) scale(1.025);
    }

    .achievement::before {
      content: '';
      position: absolute;
      left: 26px;
      top: 36px;
      width: 24px;
      height: 24px;
      background: linear-gradient(135deg, #e10000 60%, #ff512f 100%);
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(225,0,0,0.13);
      z-index: 2;
      border: 3px solid #fff;
    }

    .achievement .year {
      color: #e10000;
      font-weight: 700;
      font-size: 1.1em;
      margin-right: 8px;
      vertical-align: middle;
    }

    .achievement h2 {
      font-size: 1.25rem;
      margin: 0 0 8px 0;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .achievement h2::after {
      content: "🚩";
      font-size: 1.1em;
      margin-left: 8px;
      opacity: 0.7;
    }

    .achievement p {
      margin: 0;
      font-size: 1.05rem;
      color: #333;
      line-height: 1.7;
      padding-left: 2px;
    }

    @media (max-width: 700px) {
      .container {
        max-width: 98vw;
        padding: 0 2vw;
      }
      .achievement {
        padding: 22px 12px 22px 60px;
      }
      .timeline {
        left: 14px;
      }
      .achievement::before {
        left: 2px;
        width: 18px;
        height: 18px;
        top: 32px;
      }
    }

    @media (max-width: 480px) {
      .hero {
        padding: 28px 0 18px 0;
      }
      .hero h1 {
        font-size: 1.2rem;
      }
      .achievement {
        padding: 18px 6vw 18px 38px;
        margin: 24px 0;
      }
      .timeline {
        left: 2px;
      }
      .achievement::before {
        left: -10px;
        width: 14px;
        height: 14px;
        top: 28px;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="hero">
    <h1>🏆 Sunface Technologies – Achievements</h1>
  </section>

  <div class="container">
    <div class="timeline"></div>

    <div class="achievement">
      <h2><span class="year">2020:</span> AWS Hosting Migration</h2>
      <p>Upgraded server infrastructure to AWS cloud, enhancing website uptime and performance.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">2021:</span> Launch of Admission Mobile App</h2>
      <p>Developed and published an Android mobile app for educational admissions along with associated marketing campaigns.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">2022:</span> Physical Office & Meta Verification</h2>
      <p>Relocated to a central Tirupur office and achieved Meta business verification, reinforcing credibility.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">2023:</span> Govt. College Training Partner</h2>
      <p>Collaborated with a Government College as a Knowledge Partner, offering internship & training programmes in web technologies.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">2024:</span> Google Ads Verified</h2>
      <p>Received Google Ads certification and became an official Gupshup Partner, enhancing marketing capabilities.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">Top 3 Web Designers in Tirupur</span></h2>
      <p>Ranked within the top 3 web design firms locally by ThreeBestRated.com.</p>
    </div>

    <div class="achievement">
      <h2><span class="year">Internship Launch:</span> Internship Training</h2>
      <p>Started Industry-ready Internship Training programmes in full-stack development and digital marketing for Tiruppur students.</p>
    </div>

    <div class="achievement">
      <h2>3+ Years in Business</h2>
      <p>Built from a college project in 2013 to a registered GST/MSME business with over three years of experience in web and marketing.</p>
    </div>
  </div>

</body>
</html>
