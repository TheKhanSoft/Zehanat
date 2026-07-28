@php
    $code = trim($__env->yieldContent('code', 'Error'));
    $title = trim($__env->yieldContent('title', 'Something went wrong'));
    $description = trim($__env->yieldContent('description', 'We could not complete that request.'));
    $destination = \App\Support\ErrorPageDestination::resolve(request());
    $palette = match ($code) {
        '401', '403' => ['#f59e0b', '#fbbf24', 'rgba(245,158,11,.15)'],
        '404', '405', '422' => ['#2dd4bf', '#22d3ee', 'rgba(45,212,191,.14)'],
        '419', '429' => ['#a78bfa', '#c084fc', 'rgba(167,139,250,.15)'],
        '500', '503' => ['#fb7185', '#f97316', 'rgba(251,113,133,.14)'],
        default => ['#38bdf8', '#2dd4bf', 'rgba(56,189,248,.14)'],
    };
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ $code }} · {{ $title }} · {{ config('app.name', 'Zehanat') }}</title>
    <style>
        :root{color-scheme:dark;--accent:{{ $palette[0] }};--accent-2:{{ $palette[1] }};--glow:{{ $palette[2] }}}
        *{box-sizing:border-box}
        html,body{min-height:100%;margin:0}
        body{background:#020617;color:#e2e8f0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
        a{color:inherit}
        .page{position:relative;display:grid;min-height:100vh;place-items:center;overflow:hidden;padding:28px}
        .grid{position:absolute;inset:0;background-image:linear-gradient(rgba(148,163,184,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(148,163,184,.045) 1px,transparent 1px);background-size:48px 48px;mask-image:linear-gradient(to bottom,black,transparent 90%)}
        .orb{position:absolute;width:430px;height:430px;border-radius:999px;background:var(--glow);filter:blur(90px);opacity:.75}
        .orb.one{right:-170px;top:-170px}.orb.two{bottom:-230px;left:-170px;opacity:.4}
        .shell{position:relative;width:min(980px,100%);overflow:hidden;border:1px solid rgba(100,116,139,.38);border-radius:34px;background:linear-gradient(145deg,rgba(15,23,42,.94),rgba(2,6,23,.9));box-shadow:0 42px 120px rgba(0,0,0,.55);backdrop-filter:blur(22px)}
        .topline{height:1px;background:linear-gradient(90deg,transparent,var(--accent),transparent)}
        .content{display:grid;gap:36px;padding:42px}
        .brand{display:flex;align-items:center;gap:12px;color:#f8fafc;font-size:14px;font-weight:850;text-decoration:none}
        .brand-mark{display:grid;width:40px;height:40px;place-items:center;border:1px solid color-mix(in srgb,var(--accent) 28%,transparent);border-radius:13px;background:var(--glow);color:var(--accent);font-size:17px;font-weight:950}
        .status{display:inline-flex;align-items:center;gap:8px;margin-top:42px;padding:7px 11px;border:1px solid color-mix(in srgb,var(--accent) 25%,transparent);border-radius:999px;background:var(--glow);color:var(--accent);font-size:11px;font-weight:850;letter-spacing:.16em;text-transform:uppercase}
        .status-dot{width:7px;height:7px;border-radius:50%;background:var(--accent);box-shadow:0 0 18px var(--accent)}
        h1{max-width:650px;margin:18px 0 0;color:#f8fafc;font-size:clamp(36px,7vw,68px);font-weight:950;letter-spacing:-.055em;line-height:.98}
        .lead{max-width:640px;margin:20px 0 0;color:#94a3b8;font-size:clamp(15px,2vw,18px);line-height:1.75}
        .actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:30px}
        .button{display:inline-flex;min-height:48px;align-items:center;justify-content:center;gap:9px;border-radius:14px;padding:0 19px;font-size:14px;font-weight:850;text-decoration:none;transition:transform .2s ease,border-color .2s ease,background .2s ease}
        .button:hover{transform:translateY(-2px)}
        .primary{border:1px solid transparent;background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#020617;box-shadow:0 14px 35px var(--glow)}
        .secondary{border:1px solid rgba(100,116,139,.5);background:rgba(15,23,42,.7);color:#cbd5e1}
        .secondary:hover{border-color:color-mix(in srgb,var(--accent) 38%,#475569);color:#fff}
        .visual{position:relative;display:grid;min-height:280px;place-items:center}
        .ring{position:absolute;border:1px solid color-mix(in srgb,var(--accent) 20%,transparent);border-radius:50%}
        .ring.one{width:280px;height:280px;animation:spin 24s linear infinite}.ring.two{width:205px;height:205px;border-style:dashed;animation:spin 18s linear infinite reverse}
        .ring:before,.ring:after{position:absolute;width:10px;height:10px;border-radius:50%;background:var(--accent);box-shadow:0 0 24px var(--accent);content:""}
        .ring:before{left:22px;top:49px}.ring:after{bottom:30px;right:44px}
        .code{position:relative;color:transparent;font-size:clamp(88px,17vw,168px);font-weight:950;letter-spacing:-.08em;line-height:1;background:linear-gradient(145deg,#f8fafc 10%,var(--accent) 72%);background-clip:text;-webkit-background-clip:text;filter:drop-shadow(0 16px 32px var(--glow))}
        .meta{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;border-top:1px solid rgba(51,65,85,.65);padding:18px 42px;color:#475569;font-size:11px}
        .path{max-width:420px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
        @keyframes spin{to{transform:rotate(360deg)}}
        @media(min-width:800px){.content{grid-template-columns:minmax(0,1.25fr) minmax(300px,.75fr);align-items:center;padding:54px 58px}.status{margin-top:52px}}
        @media(max-width:799px){.visual{grid-row:1;min-height:190px}.ring.one{width:205px;height:205px}.ring.two{width:145px;height:145px}.content{padding:28px}.status{margin-top:4px}.meta{padding:17px 28px}}
        @media(prefers-reduced-motion:reduce){.ring{animation:none}.button{transition:none}}
    </style>
</head>
<body>
    <main class="page">
        <div class="grid" aria-hidden="true"></div>
        <div class="orb one" aria-hidden="true"></div>
        <div class="orb two" aria-hidden="true"></div>

        <section class="shell">
            <div class="topline"></div>
            <div class="content">
                <div>
                    <a class="brand" href="{{ url('/') }}">
                        <span class="brand-mark">Z</span>
                        <span>{{ config('app.name', 'Zehanat') }}</span>
                    </a>

                    <div class="status"><span class="status-dot"></span> HTTP {{ $code }}</div>
                    <h1>{{ $title }}</h1>
                    <p class="lead">{{ $description }}</p>

                    <div class="actions">
                        <a class="button primary" href="{{ $destination['url'] }}">
                            {{ $destination['label'] }}
                            <span aria-hidden="true">→</span>
                        </a>
                        <button class="button secondary" type="button" onclick="if (history.length > 1) history.back(); else location.href='{{ url('/') }}'">
                            <span aria-hidden="true">←</span>
                            Go back
                        </button>
                    </div>
                </div>

                <div class="visual" aria-hidden="true">
                    <div class="ring one"></div>
                    <div class="ring two"></div>
                    <div class="code">{{ $code }}</div>
                </div>
            </div>

            <footer class="meta">
                <span>Context: {{ ucfirst($destination['context']) }}</span>
                <span class="path">{{ request()->path() === '/' ? '/' : '/'.request()->path() }}</span>
            </footer>
        </section>
    </main>
</body>
</html>
