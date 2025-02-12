# **To-Do List for Inventory Management App (Laravel + Vue.js)**

## **1. Project Setup**
✅ Install Laravel  
✅ Install MySQL and configure database connection  
✅ Install Vue.js and dependencies (`vue`, `vue-router`, `bootstrap`)  
✅ Install Laravel UI and Vue scaffolding  
✅ Set up Vite for Vue integration

## **2. Database & Models**
✅ Create `Car` model with migration
- `name` (required)
- `registration_number` (required only if registered)
- `is_registered` (boolean)

✅ Create `Part` model with migration
- `name` (required)
- `serial_number` (required)
- `car_id` (foreign key to `Car`)

✅ Define **One-to-Many** relationship (`Car` → `Part`)

## **3. Backend (Laravel)**
✅ Create controllers (`CarController`, `PartController`)  
✅ Implement CRUD operations for **Cars** and **Parts**  
✅ Validate input fields (name, serial number required; registration number only if registered)  
✅ Implement filtering for the car/part list (Bonus)

## **4. Frontend (Vue.js + Blade)**
✅ Create Vue components for:
- **Car List** (`Cars.vue`)
- **Part List** (`Parts.vue`)
- **Create/Edit/Delete Car**
- **Create/Edit/Delete Part**

✅ Use **Vue Router** for navigation  
✅ Integrate Vue into **Blade template**  
✅ Use **Bootstrap** for styling

## **5. Testing & Deployment**
✅ Test all CRUD operations  
✅ Check database integrity  
✅ Ensure form validation works  
✅ Deploy to a repository or send source files  
