require('dotenv').config();
const express = require('express');
const axios = require('axios');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors());

// Azure Cognitive Services
const endpoint = process.env.AZURE_TEXT_ANALYTICS_ENDPOINT;
const key = process.env.AZURE_TEXT_ANALYTICS_KEY;

const analyzeSentiment = async (text) => {
  const response = await axios.post(
    `${endpoint}/text/analytics/v3.2/sentiment`,
    {
      documents: [
        {
          id: "1",
          language: "id",
          text: text
        }
      ]
    },
    {
      headers: {
        'Ocp-Apim-Subscription-Key': key,
        'Content-Type': 'application/json'
      }
    }
  );
  return response.data.documents[0];
};

// Mood Harian
app.post('/api/mood', async (req, res) => {
  const { moodText } = req.body;
  try {
    const result = await analyzeSentiment(moodText);
    const sentiment = result.sentiment;
    res.json({ label: sentiment });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Gagal menganalisis mood.' });
  }
});

// Analisis Sentimen
app.post('/api/sentiment', async (req, res) => {
  const { text } = req.body;
  try {
    const result = await analyzeSentiment(text);
    const sentiment = result.sentiment;
    res.json({ label: sentiment });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Gagal menganalisis sentimen.' });
  }
});

// Chatbot Konseling (Dummy Azure Function atau Local Prompt)
app.post('/api/activity', async (req, res) => {
  const { mood } = req.body;

  // Dummy logic - bisa diganti ke Azure OpenAI jika punya akses
  const reply = `Terima kasih sudah berbagi. Saya paham kamu merasa "${mood}". Coba tarik napas dalam-dalam dan tenangkan pikiran sejenak. 🌱`;

  res.json({ recommendation: reply });
});

app.listen(3001, () => console.log("Backend running on port 3001"));
