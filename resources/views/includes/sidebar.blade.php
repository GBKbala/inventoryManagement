 <!-- Menu -->
 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo ">
      <a href="javascript:void(0);" class="app-brand-link">
         <span class="app-brand-logo demo">
         <svg width="64px" height="64px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M19.838 5.455a1 1 0 00-.432-.369l-9-4a.999.999 0 00-.812 0l-9 4A1 1 0 000 6v14h2V6.65l8-3.556 8 3.556V20h2V6a1 1 0 00-.162-.545zM12 8h4v4h-4V8zm-2 2H4v10h6V10zm6 4h-4v6h4v-6z" fill="#5C5F62"></path></g></svg>
         </span>
         <span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Inventory</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
   </div>
   <div class="menu-inner-shadow"></div>
      <ul class="menu-inner py-1">

         <!-- menu start -->
         <li class="menu-item open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons bx bx-cart-alt'></i>
               <div class="text-truncate" data-i18n="eCommerce">Inventory Items</div>
            </a>
            <ul class="menu-sub">
            
               <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                     <div class="text-truncate" data-i18n="Products">Items</div>
                  </a>
                  <ul class="menu-sub">
                     <li class="menu-item">
                        <a href="{{ route('itemList') }}" class="menu-link">
                           <div class="text-truncate" data-i18n="Product list">Items list</div>
                        </a>
                     </li>
                     <!-- <li class="menu-item">
                        <a href="app-ecommerce-product-add.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Add Product">Add Item</div>
                        </a>
                     </li> -->

                  </ul>
               </li>
               <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                     <div class="text-truncate" data-i18n="Order">Order</div>
                  </a>
                  <ul class="menu-sub">
                     <li class="menu-item">
                        <a href="app-ecommerce-order-list.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Order list">Order list</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="app-ecommerce-order-details.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Order Details">Order Details</div>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                     <div class="text-truncate" data-i18n="Customer">Customer</div>
                  </a>
                  <ul class="menu-sub">
                     <li class="menu-item">
                        <a href="app-ecommerce-customer-all.html" class="menu-link">
                           <div class="text-truncate" data-i18n="All Customers">All Customers</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                           <div class="text-truncate" data-i18n="Customer Details">Customer Details</div>
                        </a>
                        <ul class="menu-sub">
                           <li class="menu-item">
                              <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                 <div class="text-truncate" data-i18n="Overview">Overview</div>
                              </a>
                           </li>
                           <li class="menu-item">
                              <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                 <div class="text-truncate" data-i18n="Security">Security</div>
                              </a>
                           </li>
                           <li class="menu-item">
                              <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                 <div class="text-truncate" data-i18n="Address & Billing">Address & Billing</div>
                              </a>
                           </li>
                           <li class="menu-item">
                              <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
                                 <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
              
            </ul>
         </li>
         <!-- e-commerce-app menu end -->
        
         @can('view-user')
            <li class="menu-item">
               <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div class="text-truncate" data-i18n="Users">Users</div>
               </a>
               <ul class="menu-sub">
                  <li class="menu-item">
                     <a href="{{ route('users') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="List">List</div>
                     </a>
                  </li>
               </ul>
            </li>
         @endcan
         <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons bx bx-check-shield'></i>
               <div class="text-truncate" data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="app-access-roles.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Roles">Roles</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="app-access-permission.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Permission">Permission</div>
                  </a>
               </li>
            </ul>
         </li> -->
        
      
         
      </ul>
</aside>
<!-- / Menu -->