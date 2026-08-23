<!-- Full Viewport Project Detail Modal Overlay (Frame 46) -->
<div id="project-modal" class="project-modal-backdrop select-none hidden" aria-hidden="true" role="dialog" aria-modal="true">

  <!-- Centered Canvas Container (Header + Content share identical width & alignment) -->
  <div class="frame46-container project-modal-card max-w-4xl mx-auto my-8 bg-[#121216] border border-[#262632] rounded-3xl overflow-hidden shadow-2xl">

    <!-- Top Navigation Bar: Single Unified Breadcrumb Capsule spanning across the header -->
    <div class="frame46-header p-6 border-b border-[#22222a] bg-[#16161c]">
      
      <!-- Unified Breadcrumb Pill with Inside Logo & Vertical Divider -->
      <div class="frame46-breadcrumb flex items-center justify-between">
        
        <div class="flex items-center space-x-3">
          <!-- Purple Back Button -->
          <button type="button" id="project-modal-close-btn" class="frame46-back-btn w-8 h-8 rounded-full bg-[#875af5]/20 hover:bg-[#875af5] text-[#875af5] hover:text-white flex items-center justify-center transition-all" aria-label="Close project details">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M1.67044 3.46338C1.74291 3.28841 1.86565 3.13886 2.02312 3.03365C2.1806 2.92844 2.36573 2.87229 2.55512 2.87231H8.9381C10.2078 2.87231 11.4254 3.37668 12.3232 4.27446C13.221 5.17224 13.7253 6.38989 13.7253 7.65955C13.7253 8.9292 13.221 10.1469 12.3232 11.0446C11.4254 11.9424 10.2078 12.4468 8.9381 12.4468H3.19342C2.93949 12.4468 2.69596 12.3459 2.5164 12.1664C2.33685 11.9868 2.23597 11.7433 2.23597 11.4893C2.23597 11.2354 2.33685 10.9919 2.5164 10.8123C2.69596 10.6328 2.93949 10.5319 3.19342 10.5319H8.9381C9.69989 10.5319 10.4305 10.2293 10.9692 9.6906C11.5078 9.15193 11.8104 8.42134 11.8104 7.65955C11.8104 6.89776 11.5078 6.16717 10.9692 5.6285C10.4305 5.08983 9.69989 4.78721 8.9381 4.78721H4.8664L5.4664 5.38721C5.64072 5.56787 5.73711 5.80977 5.73481 6.06081C5.73252 6.31184 5.63171 6.55194 5.45411 6.72937C5.2765 6.90681 5.03631 7.00739 4.78527 7.00945C4.53423 7.01151 4.29242 6.91489 4.11193 6.7404L1.87789 4.50636C1.74409 4.37248 1.65297 4.20195 1.61605 4.01632C1.57913 3.83068 1.59805 3.63826 1.67044 3.46338Z" fill="currentColor"/>
            </svg>
          </button>

          <!-- Recessed Path Pill -->
          <div class="frame46-path-pill px-3 py-1 bg-[#0e0e12] rounded-full border border-[#22222a]">
            <span id="project-modal-path" class="frame46-path-text font-mono text-xs text-gray-400">
              ODDS_Project/Theodore/Project_Story
            </span>
          </div>
        </div>

        <div id="project-modal-links" class="flex items-center space-x-2">
          <!-- Demo / Repo buttons populated via JS -->
        </div>

      </div>

    </div>

    <!-- Modal Dynamic Content Area -->
    <div class="p-8 md:p-12 space-y-8 max-h-[80vh] overflow-y-auto">
      
      <!-- Header Meta Block -->
      <div class="space-y-3 border-b border-[#22222a] pb-6">
        <div class="flex items-center space-x-3">
          <span id="project-modal-category" class="px-2.5 py-0.5 rounded-full bg-[#875af5]/15 text-[#875af5] text-xs font-bold uppercase tracking-wider">
            Category
          </span>
          <span id="project-modal-year" class="text-xs font-mono text-gray-500">2024</span>
        </div>

        <h1 id="project-modal-title" class="text-2xl md:text-4xl font-extrabold text-white tracking-tight">
          PROJECT TITLE
        </h1>

        <p id="project-modal-desc" class="text-sm md:text-base text-gray-400 leading-relaxed">
          Short project overview hook...
        </p>
      </div>

      <!-- Rendered Notion Blocks Container -->
      <div id="project-modal-blocks" class="space-y-4 text-gray-200 text-sm md:text-base leading-relaxed">
        <!-- Injected via JavaScript -->
      </div>

    </div>

  </div>

</div>
