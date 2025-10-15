import './bootstrap';
import React from "react";
import ReactDOM from "react-dom/client";
import { WagmiProvider, useAccount } from "wagmi";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import {
    RainbowKitProvider,
    getDefaultConfig,
    useConnectModal,
} from "@rainbow-me/rainbowkit";
import { mainnet, polygon, optimism, arbitrum } from "wagmi/chains";
import "@rainbow-me/rainbowkit/styles.css";

// ✅ Wagmi + RainbowKit configuration
const config = getDefaultConfig({
    appName: "My Blockchain Mini App",
    projectId: "YOUR_WALLETCONNECT_PROJECT_ID",
    chains: [mainnet, polygon, optimism, arbitrum],
});

const queryClient = new QueryClient();

// ✅ Custom Button Component
function CustomConnectButton() {
    const { openConnectModal } = useConnectModal();
    const { isConnected } = useAccount();

    return (
        <button
            onClick={openConnectModal}
            disabled={isConnected}
            className="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M17 9V7a5 5 0 00-10 0v2M5 12h14m-3 8H8a2 2 0 01-2-2v-4h12v4a2 2 0 01-2 2z"
                />
            </svg>
            {isConnected ? "Wallet Connected" : "Connect Wallet"}
        </button>
    );
}

// ✅ Wallet Info Display
function WalletInfo() {
    const { address, isConnected } = useAccount();
    return (
        <div>
            {isConnected ? (
                <p className="mt-4 text-sm text-gray-800">
                    ✅ Connected wallet: <strong>{address}</strong>
                </p>
            ) : (
                <p className="mt-4 text-sm text-gray-600">
                    Please connect your wallet 👆
                </p>
            )}
        </div>
    );
}

// ✅ Main App
function App() {
    return (
        <WagmiProvider config={config}>
            <QueryClientProvider client={queryClient}>
                <RainbowKitProvider>
                    <div className="p-10 flex flex-col items-center gap-4 font-sans">
                        <h1 className="text-2xl font-bold">🌈 Welcome to My Blockchain App</h1>
                        <p>Connect your wallet below 👇</p>

                        {/* Custom Wallet Connect Button */}
                        <CustomConnectButton />

                        {/* Wallet Info */}
                        <WalletInfo />
                    </div>
                </RainbowKitProvider>
            </QueryClientProvider>
        </WagmiProvider>
    );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);