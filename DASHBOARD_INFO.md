# Dashboard E-Learning - Info

## Komponen Yang Dibuat

### 1. **Sidebar.vue**
- Sidebar navigation dengan icon
- Fixed position untuk desktop
- Hidden untuk mobile (guna bottom navigation)

### 2. **CourseCard.vue**
- Card untuk display course information
- Ada thumbnail dengan pattern design
- Tags, rating, dan views
- Hover effects untuk better UX

### 3. **CalendarWidget.vue**
- Interactive calendar
- Boleh navigate month sebelum/lepas
- Highlight hari ini dan selected date
- Fully responsive

### 4. **ScheduleWidget.vue**
- Display schedule yang upcoming
- Highlight schedule yang important
- Simple dan clean design

### 5. **HoursChart.vue**
- Bar chart untuk hours spent
- Interactive dengan hover effects
- Auto-scaling based on data

### 6. **Dashboard.vue**
- Main dashboard page
- Responsive layout (mobile & desktop)
- Tab filtering untuk courses (All, Active, Upcoming, Completed)
- Grid layout untuk course cards
- Mobile bottom navigation

## Cara Guna

1. **Run development server:**
```bash
npm run dev
```

2. **Access dashboard:**
- Login ke application
- Navigate ke `/dashboard`

## Design Features

✅ **Minimalist Design**
- Clean lines
- Plenty of white space
- Simple color palette
- Modern typography

✅ **Responsive**
- Desktop: Sidebar + main content + right sidebar
- Tablet: Adjusted spacing
- Mobile: Bottom navigation + stacked layout

✅ **Interactive Elements**
- Hover effects
- Tab switching
- Calendar navigation
- Smooth transitions

## Customization

Untuk tukar data, edit di `/resources/js/Pages/Dashboard.vue`:

```javascript
// Courses data
const courses = ref([...])

// Schedule data
const schedules = ref([...])

// Hours chart data
const hoursData = ref([...])
```

## Color Scheme

- Primary: Purple (`#8B5CF6`)
- Dark: Gray-900 (`#111827`)
- Light Background: Gray-50 (`#F9FAFB`)
- Text: Gray-900, Gray-600, Gray-500

## Tech Stack

- **Laravel** - Backend framework
- **Inertia.js** - Modern monolith
- **Vue 3** - Frontend framework
- **Tailwind CSS** - Styling
- **Vite** - Build tool
