from docx import Document
import os

HEADERS = {
    "Nama": "Nama\t\t\t\t: Muhamad Farhan Maura",
    "NIM": "NIM\t\t\t\t: 221420075",
    "Program Studi": "Program Studi\t\t: Teknik Informatika",
    "Nomor HP": "Nomor HP\t\t\t: 083826383761",
    "Dosen Pembimbing": "Dosen Pembimbing\t: Rasmila, M.Kom.",
    "Lokasi Pelaksanaan": "Lokasi Pelaksanaan\t: Warung Sate Madura Bukit Baru",
    "Waktu Pelaksanaan": "Waktu Pelaksanaan\t: 06 Oktober 2025 – 19 Januari 2026"
}

def update_file(filename):
    if not os.path.exists(filename):
        print(f"Skipping {filename} (not found)")
        return

    print(f"Updating {filename}...")
    try:
        doc = Document(filename)
        modified = False
        
        # Iterate through paragraphs to find headers
        for para in doc.paragraphs[:20]:  # Check first 20 paragraphs
            text = para.text.strip()
            for key, new_text in HEADERS.items():
                if text.startswith(key):
                    if para.text != new_text:
                        para.text = new_text
                        modified = True
                        print(f"  Updated {key}")
                    break
        
        if modified:
            doc.save(filename)
            print("  Saved changes.")
        else:
            print("  No changes needed.")
            
    except Exception as e:
        print(f"  Error updating {filename}: {e}")

def main():
    for i in range(1, 17):
        filename = f"logbook minggu {i}.docx"
        update_file(filename)

if __name__ == "__main__":
    main()
