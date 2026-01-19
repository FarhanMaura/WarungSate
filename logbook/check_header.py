from docx import Document

def check(filename):
    print(f"Checking {filename}...")
    try:
        doc = Document(filename)
        for i, p in enumerate(doc.paragraphs[:15]):
            if ":" in p.text:
                print(f"P{i}: {repr(p.text)}")
    except Exception as e:
        print(f"Error reading {filename}: {e}")
        
if __name__ == "__main__":
    check("logbook minggu 1.docx")
    print("-" * 20)
    check("logbook minggu 16.docx")
