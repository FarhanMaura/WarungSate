from docx import Document
import json

def analyze_logbook(filename):
    doc = Document(filename)
    
    print(f"\n{'='*60}")
    print(f"ANALYZING: {filename}")
    print(f"{'='*60}\n")
    
    # Analyze tables
    for table_idx, table in enumerate(doc.tables):
        print(f"\n--- TABLE {table_idx + 1} ---")
        print(f"Dimensions: {len(table.rows)} rows x {len(table.columns)} columns\n")
        
        # Print each row
        for row_idx, row in enumerate(table.rows):
            print(f"Row {row_idx}:")
            for col_idx, cell in enumerate(row.cells):
                text = cell.text.strip().replace('\n', ' | ')
                if text:
                    print(f"  Col {col_idx}: {text[:200]}")
            print()

if __name__ == "__main__":
    # Analyze first logbook
    analyze_logbook("logbook minggu 1.docx")
