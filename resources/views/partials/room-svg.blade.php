<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" class="w-full max-w-3xl">
  <defs>
    <radialGradient id="bulbHalo" cx="50%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#fef08a" stop-opacity="0.7"/>
      <stop offset="60%" stop-color="#fbbf24" stop-opacity="0.2"/>
      <stop offset="100%" stop-color="#f59e0b" stop-opacity="0"/>
    </radialGradient>
    <radialGradient id="switchGlow" cx="50%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#34d399" stop-opacity="0.8"/>
      <stop offset="100%" stop-color="#10b981" stop-opacity="0"/>
    </radialGradient>
    <linearGradient id="ledBar" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%"   stop-color="#fbbf24" stop-opacity="0.1"/>
      <stop offset="50%"  stop-color="#fef08a" stop-opacity="0.6"/>
      <stop offset="100%" stop-color="#fbbf24" stop-opacity="0.1"/>
    </linearGradient>
    <filter id="softGlow" x="-50%" y="-50%" width="200%" height="200%">
      <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
    <filter id="bulbBloom" x="-80%" y="-80%" width="260%" height="260%">
      <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
  </defs>

  {{-- Room walls --}}
  <rect x="30" y="25" width="740" height="430" rx="10" fill="none" stroke="#374151" stroke-width="3"/>
  <line x1="30"  y1="388" x2="770" y2="388" stroke="#4b5563" stroke-width="3"/>
  <line x1="30"  y1="388" x2="65"  y2="460" stroke="#374151" stroke-width="2"/>
  <line x1="770" y1="388" x2="735" y2="460" stroke="#374151" stroke-width="2"/>
  {{-- Corner column lines --}}
  <line x1="30"  y1="25"  x2="30"  y2="388" stroke="#374151" stroke-width="3"/>
  <line x1="770" y1="25"  x2="770" y2="388" stroke="#374151" stroke-width="3"/>
  {{-- Ceiling wiring conduit --}}
  <path d="M100 25 L100 60 Q100 72 112 72 L300 72 Q320 72 320 85" fill="none" stroke="#4b5563" stroke-width="2.5" stroke-dasharray="8,4"/>
  <path d="M700 25 L700 72 Q700 85 688 85 L540 85 Q530 85 530 100" fill="none" stroke="#4b5563" stroke-width="2.5" stroke-dasharray="8,4"/>

  {{-- Wall switch --}}
  <g id="wall-switch">
    <rect x="104" y="194" width="40" height="65" rx="8" fill="#111827" stroke="#6b7280" stroke-width="2.5"/>
    <rect x="113" y="204" width="22" height="30" rx="5" fill="#0f172a" stroke="#374151" stroke-width="1.5"/>
    {{-- Green on-indicator --}}
    <circle cx="124" cy="248" r="6" fill="#34d399" stroke="#10b981" stroke-width="2" filter="url(#softGlow)"/>
    <circle cx="124" cy="248" r="10" fill="none" stroke="#34d399" stroke-width="1" opacity="0.35"/>
  </g>

  {{-- Hanging bulb (glowing) --}}
  <g id="bulb">
    {{-- Cord --}}
    <line x1="400" y1="25" x2="400" y2="82" stroke="#6b7280" stroke-width="3.5"/>
    {{-- Bloom halo --}}
    <ellipse cx="400" cy="122" rx="72" ry="72" fill="url(#bulbHalo)" filter="url(#bulbBloom)"/>
    {{-- Light rays --}}
    <line x1="400" y1="75" x2="362" y2="52" stroke="#fbbf24" stroke-width="1.5" opacity="0.5"/>
    <line x1="400" y1="75" x2="438" y2="52" stroke="#fbbf24" stroke-width="1.5" opacity="0.5"/>
    <line x1="345" y1="122" x2="310" y2="114" stroke="#fbbf24" stroke-width="1.5" opacity="0.35"/>
    <line x1="455" y1="122" x2="490" y2="114" stroke="#fbbf24" stroke-width="1.5" opacity="0.35"/>
    <line x1="348" y1="162" x2="320" y2="182" stroke="#fbbf24" stroke-width="1"   opacity="0.25"/>
    <line x1="452" y1="162" x2="480" y2="182" stroke="#fbbf24" stroke-width="1"   opacity="0.25"/>
    {{-- Bulb glass --}}
    <ellipse cx="400" cy="118" rx="38" ry="46" fill="#fef9c3" fill-opacity="0.12" stroke="#fbbf24" stroke-width="3.5"/>
    {{-- Filament --}}
    <path d="M386 116 Q393 104 400 116 Q407 104 414 116" fill="none" stroke="#fde68a" stroke-width="3" stroke-linecap="round"/>
    {{-- Base --}}
    <line x1="376" y1="160" x2="424" y2="160" stroke="#f59e0b" stroke-width="3.5"/>
    <rect x="382" y="160" width="36" height="16" rx="5" fill="#1f2937" stroke="#f59e0b" stroke-width="2.5"/>
    <line x1="400" y1="176" x2="400" y2="190" stroke="#6b7280" stroke-width="3"/>
    <rect x="380" y="190" width="40" height="8" rx="4" fill="#374151" stroke="#6b7280" stroke-width="2"/>
  </g>

  {{-- Ceiling fan --}}
  <g id="fan-blades">
    {{-- Drop rod --}}
    <line x1="626" y1="25" x2="626" y2="115" stroke="#6b7280" stroke-width="3.5"/>
    {{-- Hub --}}
    <circle cx="626" cy="128" r="15" fill="#374151" stroke="#9ca3af" stroke-width="3"/>
    <circle cx="626" cy="128" r="7"  fill="#4b5563" stroke="#6b7280" stroke-width="2"/>
    {{-- Blades --}}
    <ellipse cx="626" cy="88" rx="13" ry="35" fill="#1f2937" fill-opacity="0.92" stroke="#9ca3af" stroke-width="3"   transform="rotate(0   626 128)"/>
    <ellipse cx="626" cy="88" rx="13" ry="35" fill="#1f2937" fill-opacity="0.92" stroke="#9ca3af" stroke-width="3"   transform="rotate(120 626 128)"/>
    <ellipse cx="626" cy="88" rx="13" ry="35" fill="#1f2937" fill-opacity="0.92" stroke="#9ca3af" stroke-width="3"   transform="rotate(240 626 128)"/>
  </g>

  {{-- LED strip (glowing) --}}
  <g id="led-strip">
    <rect x="80" y="374" width="640" height="16" rx="8" fill="url(#ledBar)" opacity="0.5"/>
    <rect x="80" y="377" width="640" height="10" rx="5" fill="#111827" stroke="#f59e0b" stroke-width="2.5"/>
    {{-- Dot LEDs --}}
    @foreach([120,170,220,270,320,370,420,470,520,570,620,670] as $x)
    <circle cx="{{ $x }}" cy="382" r="3.5" fill="#fbbf24" filter="url(#softGlow)"/>
    @endforeach
  </g>

  {{-- Monitor / TV (right wall) --}}
  <rect x="594" y="268" width="140" height="112" rx="9" fill="#0f172a" stroke="#4b5563" stroke-width="3"/>
  <rect x="605" y="278" width="118" height="78"  rx="6" fill="#060b14" stroke="#1e40af" stroke-width="2"/>
  {{-- Screen glow lines --}}
  <line x1="618" y1="294" x2="710" y2="294" stroke="#3b82f6" stroke-width="1.5" opacity="0.5"/>
  <line x1="618" y1="306" x2="698" y2="306" stroke="#3b82f6" stroke-width="1.5" opacity="0.35"/>
  <line x1="618" y1="318" x2="705" y2="318" stroke="#3b82f6" stroke-width="1.5" opacity="0.45"/>
  <line x1="618" y1="330" x2="695" y2="330" stroke="#3b82f6" stroke-width="1.5" opacity="0.3"/>
  <circle cx="725" cy="340" r="5" fill="#22c55e" stroke="#16a34a" stroke-width="1.5"/>
  <rect x="672" y="354" width="20" height="11" rx="3" fill="#1e293b" stroke="#374151" stroke-width="1.5"/>
  <rect x="655" y="363" width="54" height="5"  rx="2" fill="#1e293b" stroke="#374151" stroke-width="1.5"/>

  {{-- Extension board (left wall) --}}
  <rect x="112" y="244" width="180" height="136" rx="10" fill="#0f172a" stroke="#4b5563" stroke-width="3"/>
  <rect x="122" y="254" width="160" height="100" rx="6" fill="#060b14" stroke="#1e40af" stroke-width="2"/>
  {{-- Screen content --}}
  <line x1="135" y1="270" x2="270" y2="270" stroke="#3b82f6" stroke-width="1.5" opacity="0.45"/>
  <line x1="135" y1="284" x2="255" y2="284" stroke="#3b82f6" stroke-width="1.5" opacity="0.3"/>
  <line x1="135" y1="298" x2="260" y2="298" stroke="#3b82f6" stroke-width="1.5" opacity="0.4"/>
  {{-- Power LED --}}
  <circle cx="275" cy="368" r="7" fill="#22c55e" stroke="#16a34a" stroke-width="2" filter="url(#softGlow)"/>
  <circle cx="275" cy="368" r="11" fill="none" stroke="#22c55e" stroke-width="1" opacity="0.3"/>
  {{-- Stand --}}
  <rect x="185" y="378" width="34" height="8" rx="3" fill="#1e293b" stroke="#374151" stroke-width="1.5"/>
  <rect x="160" y="384" width="84" height="5" rx="2" fill="#1e293b" stroke="#374151" stroke-width="1.5"/>

  {{-- Extension power strip on floor --}}
  <g transform="translate(210,354)">
    <rect x="0" y="0" width="220" height="25" rx="12" fill="#1f2937" stroke="#4b5563" stroke-width="2.5"/>
    @foreach([32,68,104,140] as $sx)
    <circle cx="{{ $sx }}" cy="12" r="9" fill="#0f172a" stroke="#6b7280" stroke-width="2"/>
    <circle cx="{{ $sx }}" cy="12" r="4" fill="#060b14"/>
    @endforeach
    <circle cx="190" cy="12" r="7" fill="#ef4444" stroke="#dc2626" stroke-width="2"/>
    <path d="M0 12 Q-25 12 -25 35 Q-25 48 -45 48" fill="none" stroke="#4b5563" stroke-width="3" stroke-linecap="round"/>
  </g>

  {{-- Floating battery (shelf) --}}
  <g transform="translate(474,282)">
    <rect x="0" y="0" width="56" height="28" rx="6" fill="#1f2937" stroke="#6b7280" stroke-width="2.5"/>
    <rect x="56" y="9" width="8" height="10" rx="2" fill="#4b5563" stroke="#6b7280" stroke-width="1.5"/>
    {{-- Charge bar (green, 75%) --}}
    <rect x="3" y="3" width="38" height="22" rx="4" fill="#22c55e" opacity="0.75"/>
    <rect x="44" y="3" width="8"  height="22" rx="3" fill="#0f172a" opacity="0.5"/>
    {{-- +/- terminals label --}}
    <text x="6" y="18" fill="#0f172a" font-size="9" font-weight="900" font-family="monospace">75%</text>
    {{-- Shelf line --}}
    <line x1="-10" y1="28" x2="75" y2="28" stroke="#374151" stroke-width="2"/>
  </g>
</svg>
