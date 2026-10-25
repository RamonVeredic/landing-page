<?php

declare(strict_types=1);
if (!defined('NMS_OID_REFERENCE')) {
    http_response_code(404);
    exit;
}

return array (
  'olt-hisfocus' =>
  array (
    'name' => 'OLT Hioso / Hisfocus',
    'source' =>
    array (
      'Perangkat' => 'Hisfocus 2 PON',
      'Model' => '2P1G_DC_Turbo_Cooler',
      'Software version' => 'v7.89',
    ),
    'base_oids' =>
    array (
      0 => '.1.3.6.1.4.1.25355',
      1 => '.1.3.6.1.2.1.17',
    ),
    'oids' =>
    array (
      0 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.1.8.1.1.2.1',
        'description' => 'Informasi perangkat',
        'index' => '-',
        'method' => 'GET',
      ),
      1 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.1.1.3',
        'description' => 'RX power modul PON dalam dBm',
        'index' => '<pon>',
        'method' => 'GET',
      ),
      2 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.1.1.4',
        'description' => 'Tegangan modul PON (V)',
        'index' => '<pon>',
        'method' => 'GET',
      ),
      3 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.1.1.5',
        'description' => 'Arus bias modul PON (mA)',
        'index' => '<pon>',
        'method' => 'GET',
      ),
      4 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.1.1.6',
        'description' => 'Suhu SFP modul PON (derajat Celsius)',
        'index' => '<pon>',
        'method' => 'GET',
      ),
      5 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.3',
        'description' => 'Status uplink PON',
        'index' => '<pon>',
        'method' => 'GET',
      ),
      6 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.4',
        'description' => 'Flow control (0 = Disable, 1 = Enable)',
        'index' => '<pon>',
        'method' => 'GET + SET',
      ),
      7 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.5',
        'description' => 'Enable port (dugaan write-only)',
        'index' => '<pon>',
        'method' => 'SET',
      ),
      8 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.6',
        'description' => 'Auto-negotiation (dugaan write-only)',
        'index' => '<pon>',
        'method' => 'SET',
      ),
      9 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.7',
        'description' => 'Speed (1 = 1000M, 0 = 100M; dugaan)',
        'index' => '<pon>',
        'method' => 'SET',
      ),
      10 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.1.4.1.8',
        'description' => 'Duplex (1 = Full, 0 = Half; dugaan)',
        'index' => '<pon>',
        'method' => 'SET',
      ),
      11 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.3',
        'description' => 'ID ONU pada PON bersangkutan',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      12 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.2',
        'description' => 'Nomor PON tempat ONU berada',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      13 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.11',
        'description' => 'Alamat MAC ONU (string 12 heksadesimal)',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      14 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.37',
        'description' => 'Nama ONU yang dikonfigurasi di OLT',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      15 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.39',
        'description' => 'Status operasional ONU (1 = Up, 2 = Down)',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      16 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.35',
        'description' => 'Mode autentikasi ONU (0 = Undef, 1 = Pass, 2 = Deny)',
        'index' => '<pon>.<onu>',
        'method' => 'GET + SET',
      ),
      17 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.25',
        'description' => 'Nilai RTT mentah yang dapat digunakan untuk memperkirakan jarak ONU',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      18 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.22',
        'description' => 'Perintah reboot ONU (write-only)',
        'index' => '<pon>.<onu>',
        'method' => 'SET (1)',
      ),
      19 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.23',
        'description' => 'Perintah mengaktifkan ONU (write-only)',
        'index' => '<pon>.<onu>',
        'method' => 'SET (1)',
      ),
      20 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.24',
        'description' => 'Perintah menonaktifkan ONU (write-only)',
        'index' => '<pon>.<onu>',
        'method' => 'SET (1)',
      ),
      21 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.3.2.1.40',
        'description' => 'Factory reset ONU',
        'index' => '<pon>.<onu>',
        'method' => 'SET (1)',
      ),
      22 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.2.1.4',
        'description' => 'Daya kirim (TX power) ONU dalam dBm',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      23 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.2.1.7',
        'description' => 'Suh umodul ONU (derajat Celsius)',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
      24 =>
      array (
        'oid' => '.1.3.6.1.4.1.25355.3.2.6.14.2.1.8',
        'description' => 'Daya terima (RX power) ONU dalam dBm',
        'index' => '<pon>.<onu>',
        'method' => 'GET',
      ),
    ),
  ),
  'mikrotik' =>
  array (
    'name' => 'MikroTik RouterOS',
    'source' =>
    array (
      'Perangkat' => 'MikroTik RouterOS',
      'Model' => '-',
      'Software version' => '-',
    ),
    'base_oids' =>
    array (
      0 => '.1.3.6.1.4.1.14988',
      1 => '.1.3.6.1.2.1',
    ),
    'oids' =>
    array (
      0 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.1.0',
        'description' => 'sysDescr - deskripsi sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      1 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.3.0',
        'description' => 'sysUpTime - timeticks',
        'index' => '-',
        'method' => 'GET',
      ),
      2 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.5.0',
        'description' => 'sysName - nama sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      3 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.6.0',
        'description' => 'sysLocation - lokasi sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      4 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.3.3.1.2',
        'description' => 'hrProcessorLoad - beban prosesor',
        'index' => 'cpu index',
        'method' => 'WALK / GET per index',
      ),
      5 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.3.1.4',
        'description' => 'hrStorageAllocationUnits - besar satu unit alokasi',
        'index' => 'storage index',
        'method' => 'WALK / GET per index',
      ),
      6 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.3.1.5',
        'description' => 'hrStorageSize - jumlah unit penyimpanan',
        'index' => 'storage index',
        'method' => 'WALK / GET per index',
      ),
      7 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.3.1.6',
        'description' => 'hrStorageUsed - unit penyimpanan terpakai',
        'index' => 'storage index',
        'method' => 'WALK / GET per index',
      ),
      8 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.3.1.2',
        'description' => 'hrStorageType - jenis penyimpanan',
        'index' => 'storage index',
        'method' => 'WALK',
      ),
      9 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.3.1.3',
        'description' => 'hrStorageDescr - label penyimpanan',
        'index' => 'storage index',
        'method' => 'WALK',
      ),
      10 =>
      array (
        'oid' => '.1.3.6.1.2.1.25.2.1.2',
        'description' => 'Tipe memori pada grup hrMemory',
        'index' => '-',
        'method' => 'WALK / GET',
      ),
      11 =>
      array (
        'oid' => '.1.3.6.1.4.1.14988.1.1.5.2.0',
        'description' => 'Jumlah user hotspot yang sedang aktif (enterprise 14988)',
        'index' => '-',
        'method' => 'GET',
      ),
      12 =>
      array (
        'oid' => '.1.3.6.1.4.1.14988.1.1.5.1.1.3',
        'description' => 'Nama user hotspot aktif',
        'index' => 'index user',
        'method' => 'WALK',
      ),
      13 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.2',
        'description' => 'ifDescr - deskripsi antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      14 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.3',
        'description' => 'ifType - tipe antarmuka (Ethernet, PPP, VLAN, dan lain-lain)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      15 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.5',
        'description' => 'ifSpeed - kecepatan dalam bit per detik',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      16 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.6',
        'description' => 'ifPhysAddress - alamat fisik antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      17 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.7',
        'description' => 'ifAdminStatus - status administratif (1 = Up, 2 = Down)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      18 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.8',
        'description' => 'ifOperStatus - status operasional (1 = Up, 2 = Down)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      19 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.1',
        'description' => 'ifName - nama singkat antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      20 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.15',
        'description' => 'ifHighSpeed - kecepatan dalam Mbps',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      21 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.18',
        'description' => 'ifAlias - alias yang diisi operator',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      22 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.6',
        'description' => 'ifHCInOctets - jumlah oktet masuk',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      23 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.10',
        'description' => 'ifHCOutOctets - jumlah oktet keluar',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      24 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.10',
        'description' => 'ifInOctets - jumlah oktet masuk versi lama',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      25 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.16',
        'description' => 'ifOutOctets - jumlah oktet keluar versi lama',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
    ),
  ),
  'cisco' =>
  array (
    'name' => 'Cisco Catalyst 2960-S',
    'source' =>
    array (
      'Perangkat' => 'Cisco Catalyst 2960-S',
      'Model' => 'WS-C2960S-24TS-L',
      'Software version' => 'Cisco IOS 12.2(55)SE7',
    ),
    'base_oids' =>
    array (
      0 => '.1.3.6.1.4.1.9',
      1 => '.1.3.6.1.2.1',
    ),
    'oids' =>
    array (
      0 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.1.0',
        'description' => 'sysDescr - deskripsi sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      1 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.3.0',
        'description' => 'sysUpTime - timeticks (dibagi 100 menjadi detik)',
        'index' => '-',
        'method' => 'GET',
      ),
      2 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.5.0',
        'description' => 'sysName - nama sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      3 =>
      array (
        'oid' => '.1.3.6.1.2.1.1.6.0',
        'description' => 'sysLocation - lokasi sistem',
        'index' => '-',
        'method' => 'GET',
      ),
      4 =>
      array (
        'oid' => '.1.3.6.1.2.1.47.1.1.1.1.5',
        'description' => 'entPhysicalClass - kelas entitas fisik',
        'index' => 'ent index',
        'method' => 'WALK / GET',
      ),
      5 =>
      array (
        'oid' => '.1.3.6.1.2.1.47.1.1.1.1.7',
        'description' => 'entPhysicalName - nama entitas fisik',
        'index' => 'ent index',
        'method' => 'WALK / GET',
      ),
      6 =>
      array (
        'oid' => '.1.3.6.1.2.1.47.1.1.1.1.11',
        'description' => 'entPhysicalSerialNum - nomor seri',
        'index' => 'ent index',
        'method' => 'WALK / GET',
      ),
      7 =>
      array (
        'oid' => '.1.3.6.1.2.1.47.1.1.1.1.13',
        'description' => 'entPhysicalModelName - nama model',
        'index' => 'ent index',
        'method' => 'WALK / GET',
      ),
      8 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.109.1.1.1.1.8',
        'description' => 'cpmCPUTotal5secRev - CPU rata-rata 5 detik',
        'index' => 'cpu index',
        'method' => 'WALK / GET',
      ),
      9 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.109.1.1.1.1.5',
        'description' => 'cpmCPUTotal5sec - versi lama',
        'index' => 'cpu index',
        'method' => 'WALK / GET',
      ),
      10 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.48.1.1.1.5',
        'description' => 'ciscoMemoryPoolUsed - memori terpakai',
        'index' => 'pool index',
        'method' => 'WALK / GET',
      ),
      11 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.48.1.1.1.6',
        'description' => 'ciscoMemoryPoolFree - memori bebas',
        'index' => 'pool index',
        'method' => 'WALK / GET',
      ),
      12 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.68.1.2.2.1.2',
        'description' => 'vmVlan - VLAN port akses',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      13 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.46.1.6.1.1.5',
        'description' => 'vlanTrunkPortNativeVlan',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      14 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.46.1.6.1.1.11',
        'description' => 'vlanTrunkPortVlansEnabled',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      15 =>
      array (
        'oid' => '.1.3.6.1.4.1.9.9.46.1.6.1.1.14',
        'description' => 'vlanTrunkPortDynamicStatus',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      16 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.2',
        'description' => 'ifDescr - deskripsi antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      17 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.3',
        'description' => 'ifType - tipe antarmuka (Ethernet, PPP, VLAN, dan lain-lain)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      18 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.5',
        'description' => 'ifSpeed - kecepatan dalam bit per detik',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      19 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.6',
        'description' => 'ifPhysAddress - alamat fisik antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      20 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.7',
        'description' => 'ifAdminStatus - status administratif (1 = Up, 2 = Down)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      21 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.8',
        'description' => 'ifOperStatus - status operasional (1 = Up, 2 = Down)',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      22 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.1',
        'description' => 'ifName - nama singkat antarmuka',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      23 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.15',
        'description' => 'ifHighSpeed - kecepatan dalam Mbps',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      24 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.18',
        'description' => 'ifAlias - alias yang diisi operator',
        'index' => 'ifIndex',
        'method' => 'WALK (GETNEXT)',
      ),
      25 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.6',
        'description' => 'ifHCInOctets - jumlah oktet masuk',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      26 =>
      array (
        'oid' => '.1.3.6.1.2.1.31.1.1.1.10',
        'description' => 'ifHCOutOctets - jumlah oktet keluar',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      27 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.10',
        'description' => 'ifInOctets - jumlah oktet masuk versi lama',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
      28 =>
      array (
        'oid' => '.1.3.6.1.2.1.2.2.1.16',
        'description' => 'ifOutOctets - jumlah oktet keluar versi lama',
        'index' => 'ifIndex',
        'method' => 'WALK / GET',
      ),
    ),
  ),
);
