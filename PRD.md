# Product Requirements Document (PRD): Sistem Pengaduan Masyarakat (Public Complaint Management System)

---

## 1. Executive Summary & Project Overview

### 1.1 Vision & Mission
**Sistem Pengaduan Masyarakat** is an integrated, transparent, and citizen-centric civic engagement platform. It bridges community members with local government institutions to report infrastructure issues, public service grievances, safety violations, and environmental concerns. The platform guarantees rapid triage, full status transparency, and accountability across governmental departments.

### 1.2 Core Objectives
- **Empower Citizens**: Provide a simple, accessible, mobile-first web portal for reporting issues with photo attachments and geolocation.
- **Ensure Transparency**: Offer real-time tracking via ticket IDs and a public dashboard of resolved municipal grievances.
- **Optimize Municipal Triage**: Provide city administrators with a data-dense, high-efficiency dashboard with filtering, bulk actions, SLA indicators, and disposition management.
- **Data-Driven Governance**: Aggregate statistics on complaint categories, resolution times, and community satisfaction to inform city budget and maintenance priorities.

---

## 2. Target Personas & Stakeholders

| Persona | Role | Key Motivations & Needs |
| :--- | :--- | :--- |
| **Warga / Citizen** | General public reporter | Wants quick, frictionless reporting without complicated signups; wants privacy protection and clear updates on ticket progress. |
| **Admin Pengaduan / Case Officer** | Municipal staff triage agent | Needs rapid triage tools, duplicate detection, categorization, reassignment to field units, and SLA tracking. |
| **Kepala Dinas / Executive Supervisor** | City director / Stakeholder | Needs high-level analytics, trend tracking, resolution rates, and departmental response performance metrics. |
| **Public Observer / Journalist** | Civic oversight | Views public transparency portal to inspect resolved matters and community trust statistics. |

---

## 3. Product Architecture & Information Architecture (IA)

### 3.1 Public Portal Architecture (Citizen-Facing)
1. **Homepage (`/`)**:
   - Hero banner with primary CTAs: *"Buat Pengaduan"* and *"Lacak Status"*.
   - Live metrics banner (Total Laporan, Laporan Selesai, Waktu Respon Rata-rata).
   - "Cara Kerja" (3-step reporting workflow).
   - Latest resolved reports preview (civic showcase).
   - Mobile application banner & emergency hotlines.
2. **Buat Pengaduan Baru (`/lapor`)**:
   - Multi-step structured report form (Pelapor info, kategori laporan, deskripsi, upload foto bukti, titik lokasi).
   - Anonymous/Confidential toggle option.
   - Immediate Ticket ID issuance modal with one-click copy.
3. **Lacak Status Pengaduan (`/lacak`)**:
   - Universal Ticket Search box (`#TKT-XXXXX` or `#REQ-XXXX-XXX`).
   - Chronological vertical timeline: *Terkirim -> Diverifikasi -> Sedang Ditindaklanjuti -> Selesai / Ditolak*.
   - Inspector/operator response notes and before/after verification photo comparison.
4. **Pengaduan Selesai - Public Transparency Gallery (`/transparansi`)**:
   - Filterable showcase of resolved community issues with categories and before/after photo comparisons.
5. **Tentang Kami (`/tentang`)**:
   - Mission, vision, core values, leadership team, and operational standards.
6. **Hubungi Kami (`/kontak`)**:
   - Office location map embed, hotlines (112 emergency), departmental emails, inquiry form, and operating hours.
7. **Pertanyaan Umum - FAQ (`/faq`)**:
   - Searchable knowledge base categorized by General, Process, Tracking, Privacy, and Technical support with expandable accordions.

### 3.2 Admin Portal Architecture (Government-Facing)
1. **Login Administrator (`/admin/login`)**:
   - Secure authentication with 2FA support, role identification, and session control.
2. **Admin Overview Dashboard (`/admin/dashboard`)**:
   - Key Metric KPI Cards: Total Pengaduan, Pending Verification, In-Progress, Resolved, SLA breaches.
   - Categorical breakdown bar charts (Infrastruktur, Pelayanan, Keamanan, Kesehatan, Pendidikan).
   - 7-Day / 30-Day complaint volume trend line charts.
   - Recent complaints quick-triage list.
3. **Kelola Pengaduan (`/admin/pengaduan`)**:
   - High-density data table with quick status tab filters (*Semua, Pending, Proses, Selesai, Ditolak*).
   - Multi-parameter search and date range pickers.
   - Bulk actions (bulk status updates, bulk assignments, bulk deletion/archiving).
   - Single-click row navigation to full case details.
4. **Detail Pengaduan & Tindak Lanjut (`/admin/pengaduan/:id`)**:
   - Split-screen workspace: Left column (60%) for ticket metadata, reporter contact details, full description, and high-res evidence photos; Right column (40%) for status update actions, administrative reply notes, audit activity log, and deletion/escalation controls.

---

## 4. Key Functional Requirements

### 4.1 Citizen Experience (Public)
- **FR-PUB-01: Anonymous / Confidential Reporting**: Users can flag their report as "Rahasia / Anonim" to hide their personal identity from public display.
- **FR-PUB-02: Ticket Generation**: Automated, unique alphanumeric ticket identifier generated upon submission.
- **FR-PUB-03: Real-Time Ticket Tracking**: Real-time status retrieval without mandatory citizen login.
- **FR-PUB-04: Multimedia Upload**: Support for photo/evidence uploads (PNG, JPG, HEIC up to 10MB) with auto-resizing.
- **FR-PUB-05: Geolocation Tagging**: Integration with map coordinates / address auto-fill for precise location targeting.

### 4.2 Admin Experience (Internal)
- **FR-ADM-01: Role-Based Access Control (RBAC)**: Super Admin, Verificator, Department Officer, and Read-Only Inspector roles.
- **FR-ADM-02: Status Lifecycle Management**:
  - `PENDING` (Baru masuk / Menunggu verifikasi)
  - `PROSES` (Diverifikasi dan ditugaskan ke dinas terkait)
  - `SELESAI` (Pekerjaan tuntas dengan bukti foto perbaikan)
  - `DITOLAK` (Laporan tidak valid / duplikat dengan alasan tertulis)
- **FR-ADM-03: Official Response Dispatch**: Case notes can be published as citizen-visible updates or saved as internal internal notes.
- **FR-ADM-04: Print & Export**: Instant export of complaint dossiers into PDF/Print format for field dispatch teams.

---

## 5. Design System & Visual Guidelines

### 5.1 Color Palette
- **Primary Brand / Trust Blue**: `#2563EB` (Tailwind `blue-600`) to `#1E40AF` (Tailwind `blue-800`) - signifies government authority, reliability, and security.
- **Accent / Surface Tint**: `#EFF6FF` (Tailwind `blue-50`) and `#DBEAFE` (`blue-100`).
- **Dark Sidebar Canvas (Admin)**: `#0F172A` (Tailwind `slate-900`) and `#1E293B` (`slate-800`).
- **Status Semantic Palette**:
  - *Pending / Menunggu*: `#F59E0B` (Amber-500) / Background `#FEF3C7`
  - *In Progress / Proses*: `#3B82F6` (Blue-500) / Background `#DBEAFE`
  - *Resolved / Selesai*: `#10B981` (Emerald-500) / Background `#D1FAE5`
  - *Rejected / Ditolak*: `#EF4444` (Red-500) / Background `#FEE2E2`

### 5.2 Typography & Spacing
- **Font Family**: Inter, Plus Jakarta Sans, or standard sans-serif system UI.
- **Hierarchy**:
  - H1 Display: 32px - 40px, Bold (700)
  - H2 Section Header: 24px - 30px, SemiBold (600)
  - Body Text: 14px - 16px, Regular (400) / Medium (500)
  - Data Tables & Micro-copy: 12px - 13px, Medium (500)
- **Card Styling**: `rounded-xl` to `rounded-2xl`, soft border `#E2E8F0`, ambient shadows (`shadow-sm` on tables, `shadow-md` / `shadow-lg` on elevated cards).

---

## 6. Technical Stack & Implementation Guidelines

- **Frontend Architecture**: Modern responsive HTML5, Tailwind CSS, Vanilla JS / React.
- **Responsive Targets**: Mobile viewport (390px - 430px) and Desktop viewport (1280px - 1920px).
- **Security & Data Privacy**:
  - Encrypted storage for reporter PII (Citizen Identity Numbers / Email / Phone).
  - Rate limiting on submission and tracking endpoints to prevent automated scraping.
  - Sanitization of user input and uploaded media metadata (EXIF stripping for privacy).

---

## 7. Roadmap & Phase Milestones

- **Phase 1 (MVP - Current)**: Core public submission, tracking, FAQ, contact, about, admin login, admin dashboard, and complaint detail/management views.
- **Phase 2 (Enhancement)**: WhatsApp/SMS notification webhook integration for instant status updates sent to citizens.
- **Phase 3 (Mobile & AI)**: Native citizen mobile app (iOS/Android), AI-driven duplicate report detection, and automated smart-routing to relevant municipal departments based on NLP.
