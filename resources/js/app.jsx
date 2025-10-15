import React from "react";
import ReactDOM from "react-dom/client";
import { WagmiProvider, useAccount } from "wagmi";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import {
  RainbowKitProvider,
  getDefaultConfig,
  ConnectButton,
} from "@rainbow-me/rainbowkit";
import { mainnet, polygon, optimism, arbitrum } from "wagmi/chains";
import "@rainbow-me/rainbowkit/styles.css";

// ✅ RainbowKit + Wagmi configuration
const config = getDefaultConfig({
  appName: "My Blockchain Mini App",
  projectId: "YOUR_WALLETCONNECT_PROJECT_ID", // replace with your WalletConnect Project ID
  chains: [mainnet, polygon, optimism, arbitrum],
});

const queryClient = new QueryClient();

// ✅ Component to display wallet address after connecting
function WalletInfo() {
  const { address, isConnected } = useAccount();

  return (
    <div>
      {isConnected ? (
        <p style={{ marginTop: 20, fontSize: "1.1rem" }}>
          ✅ Connected wallet: <strong>{address}</strong>
        </p>
      ) : (
        <p style={{ marginTop: 20 }}>Please connect your wallet 👆</p>
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
          <div
            style={{
              padding: 40,
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
              gap: "20px",
              fontFamily: "Arial, sans-serif",
            }}
          >
            <h1>🌈 Welcome to My Blockchain App</h1>
            <p>Connect your wallet below 👇</p>

            {/* Wallet connect button */}
            <ConnectButton />

            {/* Show address after connection */}
            <WalletInfo />
          </div>
        </RainbowKitProvider>
      </QueryClientProvider>
    </WagmiProvider>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
