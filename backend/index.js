const express = require('express');
const app = express();
const axios = require('axios');
app.use(express.json());
app.use(require('cors')());

app.post('/api/mood', async (req, res) => {
  const { moodText } = req.body;
  const result = await axios.post(process.env.AZURE_MOOD_URL, { moodText });
  res.json(result.data);
});

app.listen(3001, () => console.log("Backend running on port 3001"));
