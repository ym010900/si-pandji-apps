import azure.functions as func
from transformers import pipeline

classifier = pipeline("text-classification", model="HuggingFace/stress-detector")

def main(req: func.HttpRequest) -> func.HttpResponse:
    mood_text = req.get_json().get('moodText')
    result = classifier(mood_text)[0]
    return func.HttpResponse(
        body=json.dumps(result),
        mimetype="application/json"
    )
