package util;

import models.DependencyVO;
import org.apache.log4j.Logger;
import org.w3c.dom.Document;
import org.xml.sax.InputSource;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.stream.XMLOutputFactory;
import javax.xml.stream.XMLStreamWriter;
import java.io.PrintWriter;
import java.io.StringReader;
import java.io.StringWriter;
import java.util.HashSet;
import java.util.Set;

public class XmlUtil {
    private static final Logger LOGGER = Logger.getLogger(XmlUtil.class);

    public static Document convertStringToDocument(String xmlStr) {
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        DocumentBuilder builder;
        Document doc = null;
        try {
            // LOGGER.info("Paring string " + xmlStr + " to document");
            builder = factory.newDocumentBuilder();
            doc = builder.newDocument();
            doc = builder.parse(new InputSource(new StringReader(xmlStr)));
        } catch (Exception e) {
            LOGGER.error("Parser string to document failed: ", e);
        }
        return doc;
    }

    public static String exportToXml(DependencyVO dependencyVO) {
        try {
            StringWriter stringWriter = new StringWriter();
            XMLOutputFactory xmlOutputFactory = XMLOutputFactory.newInstance();
            XMLStreamWriter xmlStreamWriter = xmlOutputFactory.createXMLStreamWriter(stringWriter);
            xmlStreamWriter.writeStartDocument();
            xmlStreamWriter.writeStartElement("");

            for (DependencyVO childDependencyVO: dependencyVO.getDependencies()) {
                String newArtifact[] = childDependencyVO.getArtifactId().split("-");
                String type = "";
                if (newArtifact.length == 1) {
                    type = "Core Plug";
                } else if (newArtifact.length == 2) {
                    type = newArtifact[0].toUpperCase() + " Plug";
                }
                xmlStreamWriter.writeCharacters("\n");
                xmlStreamWriter.writeStartElement(type);
                xmlStreamWriter.writeCharacters("\n");
                xmlStreamWriter.writeCharacters("\t");
                xmlStreamWriter.writeStartElement("dependencies");
                xmlStreamWriter.writeCharacters("\n");

                Set<String> previousGroupId = new HashSet<>();

                for (int j = 0; j < childDependencyVO.getDependencies().size(); j++) {
                    String groupId = childDependencyVO.getDependencies().get(j).getGroupId();
                    String version = childDependencyVO.getDependencies().get(j).getVersion();
                    String newVersion = version.split("-")[0];
                    if (!previousGroupId.contains(groupId)) {
                        if (Constant.CORE_PLUG.equals(type)) {
                            if (Constant.BASIC_FWK.equals(groupId) || Constant.CORE.equals(groupId)) {
                                writeXmlTag(xmlStreamWriter, groupId, version);
                            }
                        } else if (Constant.IDM_PLUG.equals(type)) {
                            String corePlug = ("com.alcatel.axs.basic." + newArtifact[1] + "." + newVersion);
                            if (Constant.CORE.equals(groupId) || Constant.IDM_PLUGIN_FWK.equals(groupId) || Constant.IDM_APP.equals(groupId)
                                    || Constant.OIF_APP.equals(groupId) || Constant.BASIC_FWK.equals(groupId) || corePlug.equals(groupId)) {
                                writeXmlTag(xmlStreamWriter, groupId, version);
                            }
                        } else if (Constant.APC_PLUG.equals(type)) {
                            String corePlug = ("com.alcatel.axs.basic." + newArtifact[1] + "." + newVersion);
                            if (Constant.APC_APP.equals(groupId) || Constant.APC_PLUGIN_FWK.equals(groupId) || Constant.CORE.equals(groupId)
                                    || Constant.BASIC_FWK.equals(groupId) || corePlug.equals(groupId)) {
                                writeXmlTag(xmlStreamWriter, groupId, version);
                            }
                        } else if (Constant.GSIP_PLUG.equals(type)) {
                            if (Constant.GSIP_APP.equals(groupId) || Constant.GSIP_PLUGIN_FWK.equals(groupId) || Constant.CORE
                                    .equals(groupId)) {
                                writeXmlTag(xmlStreamWriter, groupId, version);
                            }
                        } else if (Constant.SPFE_PLUG.equals(type)) {
                            String corePlug = "com.alcatel.axs.basic." + newArtifact[1] + "." + newVersion;
                            if (Constant.APC_APP.equals(groupId) || Constant.APC_PLUGIN_FWK.equals(groupId) || Constant.CORE.equals(groupId)
                                    || Constant.BASIC_FWK.equals(groupId) || Constant.SPFE_APP.equals(groupId) || Constant.SPFE_PLUGIN_FWK
                                    .equals(groupId) || corePlug.equals(groupId)) {
                                writeXmlTag(xmlStreamWriter, groupId, version);
                            }
                        }
                    }
                    previousGroupId.add(groupId);
                }
                xmlStreamWriter.writeCharacters("\t");
                xmlStreamWriter.writeEndElement();
                xmlStreamWriter.writeCharacters("\n");
                xmlStreamWriter.writeEndElement();
            }
            xmlStreamWriter.writeEndElement();
            xmlStreamWriter.writeEndDocument();
            xmlStreamWriter.flush();
            xmlStreamWriter.close();
            String xmlString = stringWriter.getBuffer().toString();
            stringWriter.close();
            xmlString = xmlString.replace("<>", "");
            xmlString = xmlString.replace("</>", "");
            // LOGGER.info("After convert to xml : " + xmlString);
            return xmlString;
        } catch (Exception e) {
            LOGGER.error("Export to XML file failed: ", e);
            return null;
        }
    }

    private static void writeXmlTag(XMLStreamWriter xmlStreamWriter, String value1, String value2) {
        try {
            xmlStreamWriter.writeCharacters("\t\t");
            xmlStreamWriter.writeStartElement("dependency");
            xmlStreamWriter.writeCharacters("\n");

            xmlStreamWriter.writeCharacters("\t\t\t");
            xmlStreamWriter.writeStartElement("groupId");
            xmlStreamWriter.writeCharacters(value1);
            xmlStreamWriter.writeEndElement();
            xmlStreamWriter.writeCharacters("\n");

            xmlStreamWriter.writeCharacters("\t\t\t");
            xmlStreamWriter.writeStartElement("version");
            xmlStreamWriter.writeCharacters(value2);
            xmlStreamWriter.writeEndElement();
            xmlStreamWriter.writeCharacters("\n");
            xmlStreamWriter.writeCharacters("\t\t");
            xmlStreamWriter.writeEndElement();
            xmlStreamWriter.writeCharacters("\n");
        } catch (Exception e) {
            LOGGER.error("Write tag failed: ", e);
        }
    }
}
