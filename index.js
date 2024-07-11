const express = require('express');
const bodyParser = require('body-parser');
const axios = require('axios');

const app = express();
app.use(bodyParser.json());

const TELEGRAM_BOT_TOKEN = process.env.TELEGRAM_BOT_TOKEN;
const WEBHOOK_URL = process.env.WEBHOOK_URL;

const TELEGRAM_API_URL = `https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}`;

app.post('/webhook', (req, res) => {
  const { message } = req.body;

  if (message && message.text) {
    const chatId = message.chat.id;
    const responseText = `You said: ${message.text}`;
    
    axios.post(`${TELEGRAM_API_URL}/sendMessage`, {
      chat_id: chatId,
      text: responseText,
    }).then(response => {
      res.send('Message sent');
    }).catch(err => {
      console.error('Error sending message', err);
      res.send('Error sending message');
    });
  } else {
    res.send('No message text');
  }
});

// Set the webhook
axios.post(`${TELEGRAM_API_URL}/setWebhook`, {
  url: WEBHOOK_URL,
}).then(response => {
  console.log('Webhook set:', response.data);
}).catch(error => {
  console.error('Error setting webhook:', error);
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
