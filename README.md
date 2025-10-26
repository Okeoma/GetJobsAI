# 🚀 GetJobsAI  

**AI-Powered Platform to Simplify and Automate Your Job Search**

---

## 🧠 Project Overview  

**GetJobsAI** is an AI-powered web application developed by **Chronus Solutions Services**, an AI consultancy and services company based in the UK.  
The platform streamlines every aspect of the job search process — from optimizing CVs and generating tailored cover letters to automating job applications and tracking interviews — all within one secure and intuitive interface.

### 🌍 Vision  
To empower job seekers worldwide with AI tools that eliminate repetitive tasks and maximize their chances of landing their dream roles.

---

## 💼 Key Features  

### 🧾 AI CV Revamp  
Transform your resume with **AI-powered optimization** aligned with industry standards and **ATS (Applicant Tracking System)** requirements.

### 📝 Smart Cover Letter Generator  
Create **personalized cover letters** that highlight your strengths and speak directly to hiring managers.

### ⚡ Auto Job Apply  
Apply to **hundreds of relevant roles automatically** while focusing on preparing for interviews.

### 🌐 Job Aggregator  
Discover opportunities from **LinkedIn, Indeed, and Glassdoor** — all in one unified dashboard.

### 🔒 Secure Data Encryption  
Your data is protected with **enterprise-grade encryption** and privacy-first infrastructure.

### 📊 Interview Tracking  
Keep track of your application progress and gain insights into your job search performance.

---

## ⚙️ How It Works  

1. **Upload your CV** – Upload an existing resume or create one from scratch with our AI builder.  
2. **Select preferred roles** – Tell us your target job titles and industries.  
3. **Let AI apply** – Sit back as the AI matches, applies, and tracks your applications.

---

## 🧩 System Architecture  

Below is a conceptual diagram showing how the **Dockerized stack** of GetJobsAI is structured:

```text
                    ┌──────────────────────┐
                    │      Browser UI      │
                    │ (User Access: 8000)  │
                    └─────────┬────────────┘
                              │
               ┌──────────────┴──────────────┐
               │        Laravel App          │
               │ (PHP-FPM + Vite frontend)   │
               │        Port: 8000/5173      │
               └──────────────┬──────────────┘
                              │
        ┌─────────────────────┼──────────────────────┐
        │                     │                      │
┌───────┴────────┐   ┌────────┴────────┐   ┌─────────┴─────────┐
│     MySQL DB    │   │     Adminer     │   │      Node/Vite     │
│  (Port: 3306)   │   │ (Port: 8080)    │   │  (Port: 5173)      │
│  Persistent Vol │   │ DB GUI Access   │   │  Dev Hot Reloading │
└─────────────────┘   └────────────────┘   └─────────────────────┘
