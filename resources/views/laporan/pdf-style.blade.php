* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    font-family: DejaVu Serif, serif;
    background: #ffffff;
    color: #1f2937;
    font-size: 11px;
}

.pdf-header-title,
.section-title,
.summary-card strong {
    font-family: DejaVu Sans, sans-serif;
}

.pdf-wrapper {
    padding: 26px;
}

/* =========================
   HEADER
   ========================= */

.pdf-header {
    padding: 20px 22px;
    background: #4c1d95;
    color: #ffffff;
    margin-bottom: 18px;
    border-radius: 10px;
}

.pdf-header-table {
    width: 100%;
    border-collapse: collapse;
}

.pdf-header-title {
    margin: 0 0 6px;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: 0.2px;
}

.pdf-header-subtitle {
    margin: 0;
    max-width: 520px;
    color: #e9d5ff;
    font-size: 11px;
    line-height: 1.6;
}

.pdf-badge {
    display: inline-block;
    padding: 7px 11px;
    border-radius: 6px;
    background: #f8fafc;
    color: #4c1d95;
    font-size: 10px;
    font-weight: 800;
    text-align: center;
}

/* =========================
   META
   ========================= */

.pdf-meta {
    width: 100%;
    margin-bottom: 16px;
    border-collapse: collapse;
}

.pdf-meta td {
    padding: 6px 0;
    color: #64748b;
    font-size: 10.5px;
}

.pdf-meta strong {
    color: #111827;
}

/* =========================
   SUMMARY
   ========================= */

.summary-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
}

.summary-table td {
    width: 25%;
    padding: 0 6px 0 0;
}

.summary-card {
    padding: 14px 12px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    vertical-align: top;
}

.summary-card span {
    display: block;
    margin-bottom: 7px;
    color: #64748b;
    font-size: 10px;
    font-weight: 700;
}

.summary-card strong {
    display: block;
    color: #111827;
    font-size: 16px;
    font-weight: 900;
}

.summary-purple {
    border-top: 4px solid #6d28d9;
}

.summary-green {
    border-top: 4px solid #16a34a;
}

.summary-blue {
    border-top: 4px solid #2563eb;
}

.summary-orange {
    border-top: 4px solid #f97316;
}

/* =========================
   SECTION
   ========================= */

.section-title {
    margin: 20px 0 8px;
    padding-bottom: 6px;
    border-bottom: 2px solid #e5e7eb;
    color: #111827;
    font-size: 14px;
    font-weight: 900;
}

.section-title::first-letter {
    color: #4c1d95;
}

.section-description {
    margin: 0 0 10px;
    color: #64748b;
    font-size: 10.5px;
    line-height: 1.6;
}

/* =========================
   TABLE
   ========================= */

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 16px;
}

.data-table thead tr {
    background: #4c1d95;
    color: #ffffff;
}

.data-table th {
    padding: 9px 8px;
    border: 1px solid #4c1d95;
    font-size: 10px;
    text-align: left;
    font-weight: 800;
}

.data-table td {
    padding: 8px;
    border: 1px solid #e5e7eb;
    color: #334155;
    font-size: 10px;
    line-height: 1.5;
}

.data-table tbody tr:nth-child(even) {
    background: #f8fafc;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.rank-badge {
    display: inline-block;
    min-width: 22px;
    padding: 4px 6px;
    border-radius: 5px;
    background: #ede9fe;
    color: #5b21b6;
    font-size: 10px;
    font-weight: 900;
    text-align: center;
}

.category-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 5px;
    background: #eef2ff;
    color: #3730a3;
    font-size: 9.5px;
    font-weight: 800;
}

/* =========================
   INSIGHT BOX
   ========================= */

.insight-box {
    margin: 12px 0 18px;
    padding: 12px 14px;
    border-left: 4px solid #4c1d95;
    background: #f8fafc;
    color: #475569;
    font-size: 10.5px;
    line-height: 1.7;
}

.insight-box strong {
    color: #111827;
}

/* =========================
   EMPTY
   ========================= */

.empty-box {
    padding: 16px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    color: #64748b;
    text-align: center;
    margin-bottom: 16px;
}

/* =========================
   FOOTER
   ========================= */

.pdf-footer {
    margin-top: 24px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
    color: #64748b;
    font-size: 9.5px;
    line-height: 1.6;
}

.footer-table {
    width: 100%;
    border-collapse: collapse;
}

.footer-table td {
    vertical-align: top;
}

.footer-right {
    text-align: right;
}