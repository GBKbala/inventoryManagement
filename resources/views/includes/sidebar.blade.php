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

         <!-- Apps & Pages -->
         <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps &amp; Pages</span>
         </li>
         
         <!-- e-commerce-app menu start -->
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
                     <li class="menu-item">
                        <a href="app-ecommerce-product-add.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Add Product">Add Item</div>
                        </a>
                     </li>

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
        
        
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons bx bx-food-menu'></i>
               <div class="text-truncate" data-i18n="Invoice">Invoice</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="app-invoice-list.html" class="menu-link">
                     <div class="text-truncate" data-i18n="List">List</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="app-invoice-preview.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Preview">Preview</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="app-invoice-edit.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Edit">Edit</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="app-invoice-add.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Add">Add</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-user"></i>
               <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="app-user-list.html" class="menu-link">
                     <div class="text-truncate" data-i18n="List">List</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                     <div class="text-truncate" data-i18n="View">View</div>
                  </a>
                  <ul class="menu-sub">
                     <li class="menu-item">
                        <a href="app-user-view-account.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Account">Account</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="app-user-view-security.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Security">Security</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="app-user-view-billing.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Billing & Plans">Billing & Plans</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="app-user-view-notifications.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                        </a>
                     </li>
                     <li class="menu-item">
                        <a href="app-user-view-connections.html" class="menu-link">
                           <div class="text-truncate" data-i18n="Connections">Connections</div>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </li>
         <li class="menu-item">
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
         </li>
        
         

         
         <!-- Forms & Tables -->
         <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
         <!-- Forms -->
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-detail"></i>
               <div class="text-truncate" data-i18n="Form Elements">Form Elements</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="forms-basic-inputs.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Basic Inputs">Basic Inputs</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-input-groups.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Input groups">Input groups</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-custom-options.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Custom Options">Custom Options</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-editors.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Editors">Editors</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-file-upload.html" class="menu-link">
                     <div class="text-truncate" data-i18n="File Upload">File Upload</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-pickers.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Pickers">Pickers</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-selects.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Select & Tags">Select &amp; Tags</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-sliders.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Sliders">Sliders</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-switches.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Switches">Switches</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="forms-extras.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Extras">Extras</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-detail"></i>
               <div class="text-truncate" data-i18n="Form Layouts">Form Layouts</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="form-layouts-vertical.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Vertical Form">Vertical Form</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="form-layouts-horizontal.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Horizontal Form">Horizontal Form</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="form-layouts-sticky.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Sticky Actions">Sticky Actions</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-carousel"></i>
               <div class="text-truncate" data-i18n="Form Wizard">Form Wizard</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="form-wizard-numbered.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Numbered">Numbered</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="form-wizard-icons.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Icons">Icons</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item">
            <a href="form-validation.html" class="menu-link">
               <i class="menu-icon tf-icons bx bx-list-check"></i>
               <div class="text-truncate" data-i18n="Form Validation">Form Validation</div>
            </a>
         </li>
         <!-- Tables -->
         <li class="menu-item">
            <a href="tables-basic.html" class="menu-link">
               <i class="menu-icon tf-icons bx bx-table"></i>
               <div class="text-truncate" data-i18n="Tables">Tables</div>
            </a>
         </li>
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-grid"></i>
               <div class="text-truncate" data-i18n="Datatables">Datatables</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item">
                  <a href="tables-datatables-basic.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Basic">Basic</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="tables-datatables-advanced.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Advanced">Advanced</div>
                  </a>
               </li>
               <li class="menu-item">
                  <a href="tables-datatables-extensions.html" class="menu-link">
                     <div class="text-truncate" data-i18n="Extensions">Extensions</div>
                  </a>
               </li>
            </ul>
         </li>
         
      </ul>
</aside>
<!-- / Menu -->